<?php

function layoutPath($file, $type = 'admin')
{
    return $type == 'admin' ? "admin.theme." . env('THEME') . "." . $file : "website.theme." . env('WEBSITE_THEME') . "." . $file;
}

function layoutMessage($type = 'admin')
{
    return layoutPath("layout.messages", $type);
}

function layoutExtend($type = 'admin')
{
    return layoutPath("layout.app", $type);
}

function layoutExtend2($type = 'admin')
{
    return layoutPath("layout.app2", $type);
}

function layoutMenu($type = 'admin')
{
    return layoutPath("layout.menu", $type);
}

function layoutHomePage($type = 'admin')
{
    return layoutPath("home", $type);
}

function layoutFooter($type = 'admin')
{
    return layoutPath("layout.footer", $type);
}

function layoutBusinessFooter($type = 'admin')
{
    return layoutPath("layout.businessfooter", $type);
}

function layoutSideBar($type = 'admin')
{
    return layoutPath("layout.side-bar", $type);
}

function layoutContent($type = 'admin')
{
    return layoutPath("layout.content", $type);
}

function layoutPushHeader($type = 'admin')
{
    return layoutPath("layout.after-menu", $type);
}

function layoutPushFooter($type = 'admin')
{
    return layoutPath("layout.before-footer", $type);
}

function layoutPaginate($type = 'website')
{
    return layoutPath("layout.paginate", $type);
}

function layoutForm()
{
    return layoutPath("layout.form");
}

function layoutHeader()
{
    return layoutPath("layout.header");
}

function layoutBreadcrumb()
{
    return layoutPath("layout.breadcrumb");
}

function layoutTable()
{
    return layoutPath("layout.table");
}

// **************** Partnership Layout *******************

function layoutPartnership()
{
    return 'website.partnership.layout.app';
}

// **************** Business Layout *******************

function layoutBusiness()
{
    return 'website.business.layout.app';
}

// **************** Events Layout *******************

function layoutEvents()
{
    return 'website.events.layout.app';
}

// **************** Meduo New Layout *******************
function layoutIgtsHeader($type = 'website')
{
    return layoutPath("layout.igts.header", $type);
}

function layoutMeduoHeaderInner($type = 'website')
{
    return layoutPath("layout.meduo.header-inner", $type);
}

function layoutUserTab($type = 'website')
{
    return layoutPath("layout.meduo.user-tab", $type);
}
function layoutNotificationTab($type = 'website')
{
    return layoutPath("layout.meduo.notification-tab", $type);
}
function layoutMegaMenu($type = 'website')
{
    return layoutPath("layout.meduo.megamenu", $type);
}

// ************** BLOCKS ************************

function blockBestSeller($type = 'website')
{
    return layoutPath("layout.blocks.bestseller", $type);
}
function blockHomeCourseCards($type = 'website')
{
    return layoutPath("layout.blocks.home-course-cards", $type);
}
function blockHomeTalkCards($type = 'website')
{
    return layoutPath("layout.blocks.home-talk-cards", $type);
}

function blockHomeEventCards($type = 'website')
{
    return layoutPath("layout.blocks.home-event-cards", $type);
}



// * ************************** Sections *********************


function sectionBestLearning($type = 'website'){

    return layoutPath("layout.sections.bestlearning", $type);
}

function sectionLatestRelease($type = 'website'){
    return layoutPath("layout.sections.latestrelease", $type);

}

function sectionLatestReleases($type = 'website'){
    return layoutPath("layout.sections.latest", $type);

}

function sectionMasterCourses($type = 'website'){
    return layoutPath("layout.sections.masterCourses", $type);

}

function sectionCourses($type = 'website'){
    return layoutPath("layout.sections.homecourses", $type);

}

function sectionBundleCourses($type = 'website'){
    return layoutPath("layout.sections.bundleCourses", $type);

}

function sectionHomeInstructors($type = 'website'){
    return layoutPath("layout.sections.homeinstructors", $type);
}

function sectionInstructors($type = 'website')
{
    return layoutPath("layout.sections.instructors", $type);
}

function sectionPartnerCards($type = 'website')
{
    return layoutPath("layout.sections.partners-cards", $type);
}

function sectionUpcoming($type = 'website')
{
    return layoutPath("layout.sections.upcoming", $type);
}

function sectionPartners($type = 'website')
{
    return layoutPath("layout.sections.partners", $type);
}
function sectionTestimonials($type = 'website')
{
    return layoutPath("layout.sections.testimonials", $type);
}

function is_json($string, $return_data = false)
{
    $data = json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : true) : false;
}

function dataTableConfig()
{
    return [
        'dom' => 'Bfrtip',
        'buttons' => ['excel', 'print', 'reset', 'reload'],
        // 'responsive' => true,
//        'autoWidth' =>  true,
        'stateSave' => 'saveState',
        'scrollX' => true,
//        'initComplete' => "function () {
        //                            var allColumns = this.api().column().columns()[0].length -4 ;
        //                            var width = 50;
        //                            this.api().columns().every(function (index) {
        //                                var column = this;
        //                                if(index  <=  allColumns){
        //                                if(index != 0){
        //                                    width=100;
        //                                }
        //                                    var title = $('#dataTableBuilder thead th').eq(index).text()
        //                                    var input = '<input type=\"text\" class=\"form-control\" style=\"width: '+width+'px;\" placeholder=\"'+title+'\" />';
        //                                    $(input).appendTo($(column.footer()).empty())
        //                                    .on('change', function () {
        //                                        column.search($(this).val(), false, false, true).draw();
        //                                    });
        //                                }
        //                            });
        //                }"
    ];
}

function permissionArray()
{
    $psermisions = new \App\Application\Controllers\Traits\UsePermissionTrait();
    $psermisions->can(auth()->user());
    return array_keys($psermisions->permission);
}
