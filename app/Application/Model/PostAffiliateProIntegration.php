<?php
namespace App\Application\Model;

use Carbon\Carbon;
use Exception;

include_once(__DIR__.'/../Libraries/PapApi.php');

class PostAffiliateProIntegration{

    private $session;

    private $user       = 'ahmed.elsherif@igtsservice.com';
    private $pass       = 'Ar5Dp38y';
    private $baseUrl    = 'https://igts.postaffiliatepro.com/scripts/';
    private $affiliateId = null;
    public function __construct()
    {

        $this->session = new \Pap_Api_Session($this->baseUrl . 'server.php');
        if (!$this->session->login($this->user,$this->pass)) {
            throw new \Exception('Error to login PostAffiliatePro : ' .$this->session->getMessage());
        }
    }


    public function trackSale($order, $promoRow){

        if($order->aff_id){

            $productIds = "";

            $saleTracker = new \Pap_Api_SaleTracker($this->baseUrl.'sale.php', true);
            $saleTracker->setAccountId('default1');
            $saleTracker->setIp(getUserIpAddr());
            $sale1 = $saleTracker->createSale();
            $sale1->setTotalCost($order->payments->amount);

            $items = extractOrderItemTypes($order, $order->user_id);
            foreach($items as $key => $values){
                switch($key){
    
                    case 'courses': 
                        foreach($values as $value){
                            $productIds = $productIds . "," . $value->courses->title_en;
                        }
                    break;

                    case 'certificates':
                        foreach($values as $value){
                            $productIds = $productIds . "," . $value->certificates->title_en . '-' . $value->courses->title_en;
                        }
                    break;

                    case 'events':
                        foreach($values as $value){
                            $productIds = $productIds . "," . $value->events->title_en;
                        }
                    break;

                    default:
                }
            }

            $sale1->setProductID($productIds);
            $sale1->setOrderID($order->id);
            $sale1->doNotDeleteCookies();
            $sale1->setAffiliateId($order->aff_id);
            if($promoRow){
                $sale1->setCouponCode($promoRow->code);
            }

            $saleTracker->register();

        }

    }

    public function getAffiliateId($request){

        $affiliate = new \Pap_Api_Affiliate($this->session);

        if($request->cookie('PAPVisitorId')){
            $visitorId = $_COOKIE['PAPVisitorId'];

            if (strlen($visitorId) > 32) {
                $visitorId = substr($visitorId, -32);	
            }
            
            $request = new \Gpf_Rpc_GridRequest('Pap_Merchants_Tools_VisitorAffiliatesGrid', 'getRows', $this->session);
            $request->addParam('columns', new \Gpf_Rpc_Array(array(array('id'), array('visitoraffiliateid'),
            array('visitorid'), array('userid'), array('username'), array('firstname'), array('lastname'),
            array('banner'), array('bannerid'), array('banner_name'), array('banner_type'), array('banner_id'),
            array('channelid'), array('campaignid'), array('isconfirmed'), array('name'), array('rtype'), array('ip'),
            array('datevisit'), array('validto'), array('referrerurl'), array('data1'), array('data2'), array('accountid'))));
            // set filter
            $request->addFilter("visitorid", \Gpf_Data_Filter::EQUALS, $visitorId);
            $request->addFilter("rtype", \Gpf_Data_Filter::EQUALS, 'A');  //remove this line if you are using 'Split Commissions' feature
            $request->addFilter("validto", \Gpf_Data_Filter::DATE_EQUALS_GREATER, date('Y-m-d'));
            //in PAN insert here your merchant network accountid
            //$request->addFilter("accountid", Gpf_Data_Filter::EQUALS, 'default1');
            $request->setLimit(0, 1);
            
            
            try {
              $request->sendNow();
            } catch(Exception $e) {
              die("API call error: ".$e->getMessage());
            }
            
            $grid = $request->getGrid();
            
            $recordset = $grid->getRecordset();

            if ($recordset->getSize() > 0) {
                $username = $recordset->get(0)->get('username');
                $affiliate->setUsername($username);
                try {
                    $affiliate->load();
                }catch (Exception $e) {
                    die("Cannot load record: ".$e->getMessage());
                }
                $this->affiliateId = $affiliate->getRefid();
            }


        }
        
        return $this->affiliateId;

    }

}