define([
    'jquery',
    'mage/storage',
    'jquery/ui',
    'Magento_Ui/js/modal/modal',
    'jquery-ui-modules/widget'
], function ($, storage, ui, modal) {
    'use strict';

    $.widget('mage.weatherWidget', {
        options: {
            urlTime: '',
            content: '.weather-popup-content'
        },

        _create: function () {
            var options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: $.mage.__('Weather information'),
                    buttons: [],
                    modalClass: 'small-popup',
                    overlay: false
                },
                popupContent = this._getDefaultContent(),
                popup = $('<div/>').html(popupContent).modal(options);
            this._addEvents(popup);
            this._handleRequestTime();
        },

        /**
         * Add events
         *
         * @param popup
         * @private
         */
        _addEvents: function (popup) {
            var self = this;
            $('.icon-weather').on('click', function () {
                self._openPopup(popup);
            });
        },

        /**
         * Open popup
         *
         * @param popup
         * @private
         */
        _openPopup: function (popup) {
            popup.modal('openModal');
        },

        /**
         * Get Time
         *
         * @private
         */
        _handleRequestTime: function () {
            var self = this,
                url = this.options.urlTime;
            storage.get(
                url
            ).done(function (response) {
                const res = JSON.parse(response);
                self._paintContent(res);
            }).fail(function (response) {
                console.log('error:', response);
            });
        },

        /**
         * Display results
         *
         * @param data
         */
        _paintContent: function(data){
            if (data.hasOwnProperty('error')) {
               this._paintError(data);
            } else {
                this._paintSuccess(data);
            }
        },

        /**
         * @param data
         * @private
         */
        _paintError: function(data) {
            var $widget =  $(this.options.content),
                $message = $widget.find('.message'),
                $weather = $widget.find('.weather-widget');
            $message.html(data.error.message);
            $weather.hide();
            $message.show();
        },

        /**
         * @param data
         * @private
         */
        _paintSuccess: function(data) {
            var $widget = $('.weather-widget'),
                $message = $widget.find('.message'),
                $icon = $widget.find('.weather-icon img'),
                $location = $widget.find('.weather-location'),
                $condition = $widget.find('.weather-condition'),
                $temperature = $widget.find('.weather-temperature'),
                $wind = $widget.find('.weather-wind'),
                $humidity = $widget.find('.weather-humidity');
            $icon.attr('src', 'https:' + data.current.condition.icon);
            $location.text(data.location.name + ', ' + data.location.country);
            $condition.text(data.current.condition.text);
            $temperature.text(data.current.temp_c + '°C / ' + data.current.temp_f + '°F');
            $wind.text('Wind: ' + data.current.wind_kph + ' km/h, ' + data.current.wind_dir);
            $humidity.text('Humidity: ' + data.current.humidity + '%');
            $message.hide();
            $widget.show();
        },

        /**
         * Get default conten // se puede serpara un template, html
         * @returns {string}
         * @private
         */
        _getDefaultContent: function () {
            return '<div class="weather-popup-content">' +
                '<div class="message"></div>' +
                '<div class="weather-widget">\n' +
                '  <div class="weather-icon">\n' +
                '    <img src="" alt="Weather Icon">\n' +
                '  </div>\n' +
                '  <div class="weather-info">\n' +
                '    <div class="weather-location"></div>\n' +
                '    <div class="weather-condition"></div>\n' +
                '    <div class="weather-temperature"></div>\n' +
                '    <div class="weather-wind"></div>\n' +
                '    <div class="weather-humidity"></div>\n' +
                '  </div>\n' +
                '</div>' +
                '</div>';
        }
    });

    return $.mage.weatherWidget;
});
