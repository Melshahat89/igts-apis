/**
 * @file
 * Main Class
 * 
 * AhmedAbdelaziz™: Rapid Development (http://www.ahmedabdelaziz.net)
 * Copyright © 2018, AhmedAbdelaziz Software. (http://www.ahmedabdelaziz.net)
 *
 * ® Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright © 2012, Ahmed abdelaziz, Inc. (http://www.ahmedabdelaziz.net)
 * @link          hhttp://www.ahmedabdelaziz.net
 * @package       Nilecode
 * @subpackage
 * @since         2011-10-31 
 * @license
 * @author        Ahmed Abdelaziz - <a.abdelaziz.eg@gmail.com>
 * @modified      2019-01-21    Ahmed Abdel Aziz - <a.abdelaziz.eg@gmail.com>
 */

/**
 * Main Class.
 */
function Main($) {

    /**
     * Used to store refrence to the current object, we need this when context conflict happenes with "this".
     *
     * @access private
     */
    var _self = this,
            /**
             * @access private
             */
            _config = {};

    /**
     * Used to get the current object reference.
     * 
     * @access private
     * 
     * @return Object
     */
    function _() {

        return _self;
    }

    /**
     * Used to set or get specific/all configuration(s).
     * 
     * @access public
     * 
     * @desc          setter/getter of class params.  
     * 
     * @param  string the name of the parameter.
     * @param  mixed  the value of the parameter.
     * 
     * @return mixed
     */
    _().config = function(key, val) {

        if (arguments.length === 0) {

            return _()._config;
        }

        switch (typeof (key)) {

            case 'object':

                for (var index in key) {

                    _config[index] = key[index];
                }

                break;

            case 'string':

                if (arguments.length === 1) {

                    return _config[key];
                }

                _config[key] = val;
                break;

            case 'number':

                if (_config.length > key) {

                    if (arguments.length === 2) {

                        _config[key] = val;
                    } else {

                        var i = 0;

                        for (var index in _config) {

                            if (++i === key) {

                                return _config[index];
                            }
                        }
                    }
                }

                return null;
                break;
        }

        return _();
    };

    /**
     * Used to intilaize the class.
     * 
     * @access public
     * 
     * @return bool
     */
    _().init = function() {
        // Removing no-js class
        $(document.documentElement).removeClass('no-js');
        _assignEvents();
        return _();

    };

    /**
     * Used to assign events on model related items.
     *
     * @access private
     * @return bool
     */
    function _assignEvents() {

        _generalEvents();
        
        
        $('select.specialization').on('change', function() {
            if(this.value == 5){
                $(".other_specialization").show();
            }else{
                $(".other_specialization").hide();
            }
        });
        
        $(".finishFinalExam").on("click", function () {
            $( "#examwizard-question" ).submit();
        });
        

//        if (config.controller === '') {
//
//        }
    }

    /**
     * Used to assign general events
     * @author Ahmed Saharf <a.sharaf@nilecode.com>
     * @returns void
     */
    function _generalEvents() {
        // On click add_cart, add to cart
            
    }

    /**
     * Resets and hide form 
     * @access public
     * @param  object of the form.
     * @return bool
     */
    _().closeForm = function(obj) {
        obj[0].reset();
        obj.find('select').trigger('change');
        obj.find('.checked').removeClass('checked');
        obj.slideUp('slow');
    }

    /**
     * Generates Alert Obj
     * @author Ahmed Sharaf <a.sharaf@nilecode.com>
     * @access public
     * @param string alertClass one of bootstrap alert classes ex: 'alert-error', 'alert-success', ...
     * @param string contents any html elements 
     * @param bool close wheather to add close link or not. 
     * @param int fadeOut number of milliseconds before automatically fadeOut, 0 = don't fadeOut 
     * @return obj
     */
    _().generateAlertObj = function(alertClass, contents, close, fadeOut) {
        var $alertObj = $('<div/>').addClass('alert in alert-block fade'),
                closeElm = (close === true) ? '<a class="close" data-dismiss="alert">×</a>' : '';

        if (fadeOut > 0)
            setTimeout(function() {
                $alertObj.fadeOut();
            }, fadeOut);

        return $alertObj.addClass(alertClass).html(closeElm + contents);
    }


}

window.oMain = window.oMain || {};

!(function($) {
    $(function() {
        window.oMain = new Main($).config({
            
        }).init();
    });
})(jQuery);




$( document ).ready(function() {


    if (!sessionStorage.getItem('firstVisit'))
    {
        if(!$('#offersModal').hasClass('show')){

            setTimeout(function(){
                 $('#offersModal').modal('show');
            }, 5000);
    
        }

        sessionStorage.setItem('firstVisit', '1');

    } 



    if(!$('#offersModal').hasClass('show')){

        // setTimeout(function(){
        //      $('#offersModal').modal('show');
        // }, 5000);

        // setInterval(function () {
        //     $('#offersModal').modal('show');
        //  }, 5000);
    }
    
     


});




/**
 * Utils Class.
 */
var Utils = {
    /**
     * Used to check if element is empty ('', or equal to null, or is undefined).
     * 
     * @access public
     * @param  string value
     * @return bool
     */
    isEmpty: function(value) {
        return (value === undefined || value === 'undefined' || value === null || value === '' || value === {});
    },
    isObject: function(object) {
        return object && typeof object == 'object';
    },
    isEmptyObject: function(map) {
        var key, length = map.length;
        if (length === undefined) {
            for (var key in map) {
                if (!key || map[key] === undefined || !map.hasOwnProperty(key)) {
                    return true;
                }
            }
        }
        return false;
    },
    functionExists: function(functionName) {
        if (typeof function_name === 'string') {
            return (typeof window[functionName] === 'function');
        } else {
            return (functionName instanceof Function);
        }
    },
    /**
     * Used to log an element
     *
     * @access public
     * @param  string msg
     * @param  bool   alertIt
     */
    trace: function(msg, alertIt) {
        if (typeof (console) != 'undefined' && typeof (console.debug) == 'function') {
            console.debug(msg);
        } else if (!Utils.isEmpty(alertIt) && alertIt) {
            alert(msg);
        }
    },
    /**
     * Returns the given underscored_word_group as a Human Readable Word Group.
     * (Underscores are replaced by spaces and capitalized following words.)
     *
     * @access public
     * @param  string lower_case_and_underscored_word String to be made more readable
     * @return string Human-readable string
     */
    humanize: function(lowerCaseAndUnderscoredWord) {
        var stringParts = lowerCaseAndUnderscoredWord.split('_'),
                string = '';
        for (var i = 0; i < stringParts.length; ++i) {
            string += stringParts[i].substr(0, 1).toUpperCase() + stringParts[i].substr(1) + ' ';
        }
        return string;
    },
    scriptTypes: {
        INLINE: 'inline',
        EXTERNAL: 'external'
    },
    /**
     * Used to generate a script string
     * 
     * @access public
     * @param  string scriptType the type of the script inline or external
     * @param  string src the file source.
     */
    getScriptString: function(scriptType, src) {

        switch (scriptType) {
            case 'inline':
                return '<' + 'scrip' + '>' + src + '<' + '/script>';
                break;

            case 'external':
                return '<' + 'script src="' + src + '"' + '><' + '/script>';
                break;

            default:
                return null;
                break;
        }
    },
    /**
     * Used to create a script
     * 
     * @access public
     * @param  string url of the script name.
     * @param  callback parentObject
     * @param  callback functionName
     */
    createScript: function(scriptType, url, parentObject, functionName) {
        var appendToID = document.getElementsByTagName("body")[0],
                script = document.createElement('script');

        //        newScript.type = 'text/javascript';

        switch (scriptType) {
            case 'inline':
                script.innerHTML = 'document.write(\'' + this.getScriptString(this.scriptTypes.EXTERNAL, url) + '\');';
                break;

            case 'external':
                script.src = url;
                break;
            default:
                break;
        }

        appendToID.appendChild(script);

        // onreadystatechange handler works on IE only
        script.onreadystatechange = function() {
            if (this.readyState == 'complete') {
                functionName(parentObject); 
           }
        }
        script.onload = function() {
            functionName(parentObject);
        };

        return true;
    }
};

function loadModal(URL, ID = '', SECTION = '')
{   

    //$('.spinner-grow').css("display", "block");
    
    $.ajax({
        type:'GET',
        url:  URL + ID + '?section_id=' + SECTION,
        dataType: "html",
        async: false,
        cache: false,
        success: function(response)
        {
            //$('.spinner-grow').css("display", "none");

            $('#modalBody').html("");
            $('#modalBody').append(response);
        }
    });

    return true;
}

function sendAnswer(ID){


    answer = $('#addAnswerForm-'+ID+' textarea').val();

    if(answer){

        $.ajax({

            url: "/lecturequestionsanswersajax/item",
            type: "get", 
            contentType: "application/json",  
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
            "test": $('#addAnswerForm-'+ID).serialize()
            },
        
        
            success: function(data){
        
                $('#answer_'+ID+' .card_body').append('<div class="question_answer_single">' +
                '<div>' +
                '<span class="time">' +
                data.date +
                '</span>' +
                '</div>' +
                '<div>' +
                '<div>' +
                '<a href="#">' +
                data.user_name +
                '</a>' +
                '</div>' +
                '<div>' +
                data.answer.answer +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' 
                
                );
        
                $('#addAnswerForm-'+ID+' .input-group textarea').val('');   
        
            },
            error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
        
            });
    }else{

        alert('الرجاء عدم ترك حقل الاجابة فارغ');

    }


}

function sendQuestion(ID){

    question = $('#addQuestionForm-'+ID+' textarea').val();

    if(question){
            $.ajax({

    url: "/lecturequestionsajax/item",
    type: "get", 
    contentType: "application/json",  
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    data: {
    "test": $('form').serialize()
    },


    success: function(data){

        $('.questions-placeholder').hide();
        $('#questions_container').append('<div class="card">' +

        '<div class="card_header">' +
        '<button data-toggle="collapse" data-target="#answer_' + data.question_id + '" aria-expanded="true" aria-controls="answer_' + data.question_id + '">' +      
        '<span class="card_header_title">' +
        data.question.question_title +
        '</span>' +
        '</button>' +
        '</div>' +
        '<div id="answer_' + data.question_id + '" class="collapse">' +
        '<div class="card_body">' +
        '<div class="question_meta">' +
        '<div>' +
        '<small class="text_muted">' +
        '<a class="text_underline">' +
        data.user_name +
        '</a>' +
        '</small>' +
        '</div>' +
        '<small class="text_muted">' +
        data.date +
        '</small>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' 

        
        );

        $('#addQuestionForm-'+ID+' .input-group textarea').val('');   

        $('.vd_video_qtn_body').animate({scrollTop: $('#answer_'+data.question_id).offset().top}, 500);

    },
    error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }

    });
    }else{
        alert('الرجاء عدم ترك حقل السؤال فارغ');

    }

}

function addCertToCart(){

    // $('#certificatescontainer').submit(function (event){

        event.preventDefault();
        $.ajax({
       
            url: '/addcerttocart',
            type: 'GET',
            contentType: "application/json",  
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
            "Certificates": $('#certificatescontainer').serialize()
            },
            success: function(data){
                
                if(!data.success){
                    alert('الرجاء اختيار الشهادات');
                }else{
                    window.location.replace('/cart');
                }
                
            }
            
        });
        
    // });


}


    
    var $sticky = $('#test1');
    var $stickyrStopper = $('.sticky-stopper');
    if (!!$sticky.offset()) { // make sure ".sticky" element exists
  
      var generalSidebarHeight = $sticky.innerHeight();
      var stickyTop = $sticky.offset().top;
      var stickOffset = 0;
      var stickyStopperPosition = $stickyrStopper.offset().top - 300;
      var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
      var diff = stopPoint + stickOffset;
  
      $(window).scroll(function(){ // scroll event
        var windowTop = $(window).scrollTop(); // returns number
  
        if ($stickyrStopper.offset().top <= windowTop) {
            console.log('test');
            $sticky.css({ position: 'fixed', top: 0 });
        } else if (stickyTop < windowTop+stickOffset) {
            $sticky.css({ position: 'unset' });
        } else {
            $sticky.css({position: 'unset'});
        }
      });
  
    }

if(sessionStorage.getItem('hellobarclose')){
    $('.smart_bar').hide();
}

$(window).load(function() {
    // Animate loader off screen
    // $(".se-pre-con").fadeOut("slow");;
    $('#hellobar-close').on('click', function (){
        sessionStorage.setItem('hellobarclose', true);
    });


});

  
 
// $('.se-pre-con').fadeOut(300);
$('.loading').fadeOut("slow");


function submitRegisterForm() {
    var form = document.getElementById("register_form");
    form.submit();
}

function visa(){

    let orderID = '';
    let currentURL = window.location.href;

    if(currentURL.includes("directpay")){
        orderID = currentURL.substring(currentURL.lastIndexOf("/directpay/") + 11, currentURL.length);
    }
    $('#loading-spinner').show();

    $.ajax({
        url: "/site/ajaxPayVisa/" + orderID,
        type: 'get',
        success: function (data) {
            console.log(data);
            if(data.token){
                document.getElementById("visaiframe").src =
                "https://accept.paymobsolutions.com/api/acceptance/iframes/9377?payment_token="+ data.token;
                $('#PaymentsMethods').hide();
                $('#VisaDiv').show();
                $('#ChangePaymentsDiv').show();
            }     
        }, error: function () {
            alert("error!!!!");
        }
    });
}

function changeMethod() {
    $('#loading-spinner').hide();
    $('#PaymentsMethods').show();
    $('#VisaDiv').hide();
    $('#ChangePaymentsDiv').hide();
};

var courseTitles = document.querySelectorAll('.course-title');

courseTitles.forEach(function(item){

    let courseTitleContainer = item.parentNode;

    if(item.offsetHeight > courseTitleContainer.offsetHeight){
        
    }

});

    // Toggle plus minus icon on show hide of collapse element
    $(".accordion .collapse").on('.accordion show.bs.collapse', function(){
        $(this).prev().find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('.course-accordion hide.bs.collapse', function(){
        $(this).prev().find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });

    $('#hellobar-close').on('click', function (){
        alert('test');
    });


    $(window).unload(function(){
        // localStorage.clear();
      });