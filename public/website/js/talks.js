/**
 * @file
 * Talks Class
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
 * Class Talks
 * 
 * @param {type} $
 * @returns {Projects}
 */
function Talks($) {

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
        
        $('.talkRatingContainer').starRating({
            // callback

                  onHover: function(currentIndex, currentRating, $el){
                        alert(currentRating);                    
                    },
                    
                    onLeave: function(currentIndex, currentRating, $el){
                         alert(currentRating);             
                         // do something after mouseout
                    }
//                  onHover: noop,
//                  onLeave: noop

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
        if (!hasError) {
            $.ajax({
                url: config.fullUrl + '/talks/insertFeedback/' + id,
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

}

window.oTalks = window.oTalks || {};

!(function($) {
    $(function() {
        window.oTalks = new Talks($).config({
            
            feedbackAlert: '#feedbackAlert',
            feedbackForm: '#feedbackForm',
            feedbackFormES: '#feedbackForm_es_',

        }).init();
    });
})(jQuery);

