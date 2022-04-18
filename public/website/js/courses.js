/**
 * @file
 * Courses Class
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
 * Class Courses
 * 
 * @param {type} $
 * @returns {Projects}
 */
function Courses($) {

    /**
     * Used to store refrence to the current object, we need this when context conflict happenes with "this".
     *
     * @access private
     */
    var _self = this,
            /**addCertToCart
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
       
        _assignEvents();
        window.counter = 0;
        return _();
    };

    /**
     * Used to assign events on model related items.
     *
     * @access private
     * @return bool
     */
    function _assignEvents() {

        $('body').on('click', ".shipping_item", function() {
           
//            alert($(this).val());
            
//            var $this = $(this);
//            var id = $this.attr('data-course-id');
//            $.ajax({
//                url: config.fullUrl + '/courses/toggleFavourite/id/' + id,
//                beforeSend: function() {
////                    $this.val('Loading...');
//                },
//                success: function(result) {
//                    $(this).toggleClass('active');
//                }
//            });
//            
//            return false;
        });
        $('body').on('click', ".certificate_item", function() {
           
//            alert($(this).val());
            
//            var $this = $(this);
//            var id = $this.attr('data-course-id');
//            $.ajax({
//                url: config.fullUrl + '/courses/toggleFavourite/id/' + id,
//                beforeSend: function() {
////                    $this.val('Loading...');
//                },
//                success: function(result) {
//                    $(this).toggleClass('active');
//                }
//            });
//            
//            return false;
        });

        $('body').on('click', _().config('addCertToCart'), function() {
            if($('input:checkbox').is(":checked")) {
                var form = $(".cert-form");
                $.ajax({
                    url: config.fullUrl + '/courses/addCertificatesToCart',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    beforeSend: function() {

                    },
                    success: function(result) {

                        // Increase the cart counter (no need for this code but just in case)
                        var cartCount = Number($(".floated_count").text());
                        $(".floated_count").text(++cartCount);

                        //Redirect to the cart
                        window.location.href = config.fullUrl + '/cart';

                    }
                });

                return false;
            } else {
                alert("الرجاء إختيار شهادة لإضافتها الى السلة");
                return false;
            }

            //
            //     if($('input[type="checkbox"]').prop("checked") == true){
            //         var form = $(".cert-form");
            //         $.ajax({
            //             url: config.fullUrl + '/courses/addCertificatesToCart',
            //             type: 'POST',
            //             data: form.serialize(),
            //             dataType: 'json',
            //             beforeSend: function() {
            //
            //             },
            //             success: function(result) {
            //
            //                 // Increase the cart counter (no need for this code but just in case)
            //                 var cartCount = Number($(".floated_count").text());
            //                 $(".floated_count").text(++cartCount);
            //
            //                 //Redirect to the cart
            //                 window.location.href = config.fullUrl + '/cart';
            //
            //             }
            //         });
            //
            //         return false;
            //     }
            //
            //     else if($('input[type="checkbox"]').prop("checked") == false){
            // alert("الرجاء إختيار شهادة لإضافتها الى السلة");
            //         return false;
            //     }
        });
        
         $('body').on('click', _().config('popupAddCertToCart'), function() {
            if($('input[type="checkbox"].popup').prop("checked") == true){
                var form = $(".popup-cert-form");
                $.ajax({
                    url: config.fullUrl + '/courses/addCertificatesToCart',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                       
                    },
                    success: function(result) {
                        
                        // Increase the cart counter (no need for this code but just in case)
                        var cartCount = Number($(".floated_count").text());
                        $(".floated_count").text(++cartCount);
                        
                        //Redirect to the cart
                        window.location.href = config.fullUrl + '/cart';

                    }
                });
            
            }else{
		alert("الرجاء إختيار شهادة لإضافتها الى السلة");
            }
            
            return false;

        });

         //buy Directly
         $('body').on('click', _().config('popupAddCertToBuy'), function() {
                var form = $(".popup-cert-form");
                $.ajax({
                    url: config.fullUrl + '/courses/addCertificatesToDirectBuy',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    beforeSend: function() {

                    },
                    success: function(result) {
                        window.location.href =  result;
                    }


                });


            return false;

        });

//        $('body').on('click', _().config('bookmarkCourse'), function() {
//
//
//            var $this = $(this);
//            var id = $this.attr('data-course-id');
//            $.ajax({
//                url: config.fullUrl + '/courses/toggleFavourite/id/' + id,
//                beforeSend: function() {
////                    $this.val('Loading...');
//                },
//                success: function(result) {
//                    $(this).toggleClass('active');
//                }
//            });
//
//            return false;
//        });


        $('body').on('click', _().config('favouriteRemove'), function() {
            
            var $this = $(this);
            var id = $this.attr('data-course-id');
            $.ajax({
                url: config.fullUrl + '/courses/toggleFavourite/id/' + id,
                beforeSend: function() {
//                    $this.val('Loading...');
                },
                success: function(result) {
//                    $(this).parent('div.course_card').remove();
                      $.fn.yiiListView.update("favouritesList");
                }
            });
            
            return false;
        });
        
        $('body').on('click', _().config('addToCart'), function() {
            var $this = $(this);
            // var id = 20;
            var id = $this.attr('data-course-id');

            $.ajax({
                url: config.fullUrl + '/courses/addToCart/id/' + id,
                beforeSend: function() {
//                    $this.val('Loading...');
                },
                success: function(result) {
                    
                    $(_().config('addToCart')).remove();
                    $(_().config('goToCart')).show();
                    
                    // increase the cart counter
                    var cartCount = Number($(".floated_count").text());
                    $(".floated_count").text(++cartCount);
                      
                }
            });
            
//            return false;
        });
        
        
        
        // Add Certificate to cart from Page
        // $('.add_certificate_to_cart').click(function(){
        //     if($('input[type="checkbox"]').prop("checked") == true){
        //         return true;
        //     }
        //     else if($('input[type="checkbox"]').prop("checked") == false){
		// alert("الرجاء إختيار شهادة لإضافتها الى السلة");
        //         return false;
        //     }
        // });
        
        // Add certificate to cart from popup
        $('.popup_add_certificate_to_cart').click(function(){
            if($('input[type="checkbox"].popup').prop("checked") == true){
                return true;
            }
            else if($('input[type="checkbox"].popup').prop("checked") == false){
		        alert("الرجاء إختيار شهادة لإضافتها الى السلة");
                return false;
            }
        });

        $('.popup_add_certificate_to_buy').click(function(){
            if($('input[type="checkbox"].popup').prop("checked") == true){
                return true;
            }

        });

        
        
    }
    


    function getFilename(url) {
        if (url)
        {
            var m = url.toString().match(/.*\/(.+?)\./);
            if (m && m.length > 1)
            {
                return m[1];
            }
        }
        return "";
    }

    function search(nameKey, myArray){
        for (var i=0; i < myArray.length; i++) {
            if (myArray[i].id === nameKey) {
                return true;
            }
        }
        return false;
    }
    
    _().feedbackAfterValidate = function(form, data, hasError, id) {

        alert(2333423);
        if (!hasError) {
            $.ajax({
                url: config.fullUrl + '/courses/insertFeedback/' + id,
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $(_().config('feedbackAlert')).html('');
                    $('.feedback-loading-indicator').show();
                },
                success: function(result) {
                    $('.feedback-loading-indicator').hide();
                    if (result.error === true)
                        $(_().config('feedbackFormES')).html(result.message).show();
                    else {
                        $(_().config('feedbackAlert')).html(window.oMain.generateAlertObj('alert-success', result.message, true, 2000));
                    }
                    //Close the fancybox and reset the form:
                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                }
            });

            return false;
        }
        return true;
    }
    _().addAnswerValidate = function(form, data, hasError, id) {
        if (!hasError) {
            $.ajax({
                url: config.fullUrl + '/courses/addAnswer/' + id,
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $(_().config('addAnswerAlert')).html('');
                    $('.feedback-loading-indicator').show();
                },
                success: function(result) {
                    $('.feedback-loading-indicator').hide();
                    if (result.error === true)
                        $(_().config('feedbackFormES')).html(result.message).show();
                    else {
                        $(_().config('addAnswerAlert')).html(window.oMain.generateAlertObj('alert-success', result.message, true, 2000));
                    }
                    //Close the fancybox and reset the form:
                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                }
            });

            return false;
        }
        return true;
    }
    _().addQuestionValidate = function(form, data, hasError, id) {
        if (!hasError) {
            $.ajax({
                url: config.fullUrl + '/courses/addQuestion/' + id,
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $(_().config('addQuestionAlert')).html('');
                    $('.feedback-loading-indicator').show();
                },
                success: function(result) {
                    $('.feedback-loading-indicator').hide();
                    if (result.error === true)
                        $(_().config('feedbackFormES')).html(result.message).show();
                    else {
                        $(_().config('addQuestionAlert')).html(window.oMain.generateAlertObj('alert-success', result.message, true, 2000));
                    }
                    //Close the fancybox and reset the form:
                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                }
            });

            return false;
        }
        return true;
    }
    _().couponAfterValidate = function(form, data, hasError) {
        if (!hasError) {
            $.ajax({
                url: config.fullUrl + '/site/insertCoupon',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $(_().config('promotionAlert')).html('');
                },
                success: function(result) {
                    if (result.error === true)
                        $(_().config('promotionFormES')).html(result.message).show();
                    else {
                        $(_().config('promotionAlert')).html(window.oMain.generateAlertObj('alert-success', result.message, true, 2000));
                    }
                    //Close the fancybox and reset the form:
                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                }
            });

            return false;
        }
        return true;
    }

}

window.oCourses = window.oCourses || {};

!(function($) {
    $(function() {
        window.oCourses = new Courses($).config({
            
            feedbackAlert: '#feedbackAlert',
            addAnswerAlert: '#addAnswerAlert',
            promotionAlert: '#promotionAlert',
            feedbackForm: '#feedbackForm',
            feedbackFormES: '#feedbackForm_es_',
            bookmarkCourse: '.add_wishlist',
            favouriteRemove: '.favourite_remove',
            addToCart: '.add_cart',
            addCertToCart: '.add_certificate_to_cart',
            popupAddCertToCart: '.popup_add_certificate_to_cart',
            popupAddCertToBuy: '#popup_add_certificate_to_buy',
            goToCart: '.go_to_cart',
            

        }).init();
    });
})(jQuery);

