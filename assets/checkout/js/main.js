$(document).ready(function() {
    0 == window.cart_items && (window.location.href = "/cart");
    var Base64 = {
        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
        encode: function(r) {
            var t, e, o, n, i, a, c, h = "",
                f = 0;
            for (r = Base64._utf8_encode(r); f < r.length;) n = (t = r.charCodeAt(f++)) >> 2, i = (3 & t) << 4 | (e = r.charCodeAt(f++)) >> 4, a = (15 & e) << 2 | (o = r.charCodeAt(f++)) >> 6, c = 63 & o, isNaN(e) ? a = c = 64 : isNaN(o) && (c = 64), h = h + this._keyStr.charAt(n) + this._keyStr.charAt(i) + this._keyStr.charAt(a) + this._keyStr.charAt(c);
            return h
        },
        decode: function(r) {
            var t, e, o, n, i, a, c = "",
                h = 0;
            for (r = r.replace(/[^A-Za-z0-9\+\/\=]/g, ""); h < r.length;) t = this._keyStr.indexOf(r.charAt(h++)) << 2 | (n = this._keyStr.indexOf(r.charAt(h++))) >> 4, e = (15 & n) << 4 | (i = this._keyStr.indexOf(r.charAt(h++))) >> 2, o = (3 & i) << 6 | (a = this._keyStr.indexOf(r.charAt(h++))), c += String.fromCharCode(t), 64 != i && (c += String.fromCharCode(e)), 64 != a && (c += String.fromCharCode(o));
            return Base64._utf8_decode(c)
        },
        _utf8_encode: function(r) {
            r = r.replace(/\r\n/g, "\n");
            for (var t = "", e = 0; e < r.length; e++) {
                var o = r.charCodeAt(e);
                o < 128 ? t += String.fromCharCode(o) : (127 < o && o < 2048 ? t += String.fromCharCode(o >> 6 | 192) : (t += String.fromCharCode(o >> 12 | 224), t += String.fromCharCode(o >> 6 & 63 | 128)), t += String.fromCharCode(63 & o | 128))
            }
            return t
        },
        _utf8_decode: function(r) {
            for (var t = "", e = 0, o = c1 = c2 = 0; e < r.length;)(o = r.charCodeAt(e)) < 128 ? (t += String.fromCharCode(o), e++) : 191 < o && o < 224 ? (c2 = r.charCodeAt(e + 1), t += String.fromCharCode((31 & o) << 6 | 63 & c2), e += 2) : (c2 = r.charCodeAt(e + 1), c3 = r.charCodeAt(e + 2), t += String.fromCharCode((15 & o) << 12 | (63 & c2) << 6 | 63 & c3), e += 3);
            return t
        }
    };

    function make_base_auth(r, t, e) {
        var o = r + ":" + t;
        return "Basic " + Base64.encode(o)
    }
    var shopsdt = {
        shop: window.Shopify.shop
    };
    var shopifytoken = Base64.encode(JSON.stringify(shopsdt)),
        auth = make_base_auth(shopifytoken, "912ff229790c494cb062ec4152fc2f56");

    function SC(r) {
        for (key in r) document.cookie = key + "=" + r[key]
    }

    function AC(r) {
        for (var t = r + "=", e = document.cookie.split(";"), o = 0; o < e.length; o++) {
            var n = e[o].trim();
            if (0 == n.indexOf(t)) return n.substring(t.length, n.length)
        }
        return ""
    }

    function DC(r) {
        for (var t = 0; t < r.length; t++) SC({
            [r[t]]: ""
        })
    }

    function $_GET(r) {
        var t, e, o = window.location.search.substring(1).split("&");
        for (e = 0; e < o.length; e++)
            if ((t = o[e].split("="))[0] === r) return void 0 === t[1] || decodeURIComponent(t[1])
    }

    function getRootUrl() {
        return window.location.origin ? window.location.origin + "/" : window.location.protocol + "/" + window.location.host + "/"
    }

    function getBaseUrl() {
        return new RegExp(/^.*\//).exec(window.location.href)
    }

    function Sweet_alert(r) {
        swal({
            title: "Something wents wrong",
            text: r,
            type: "Danger",
            showCancelButton: !0,
            confirmButtonClass: "btn-danger sa-icon sa-error animateErrorIcon",
            confirmButtonText: "Try again",
            closeOnConfirm: !0
        })
    }

    function check_login() {
        if (AC('login') == "false") {
            DC(['shippingPrice']);
        }
    }

    function deserialize(chaine) {
        myjson = {}
        tabparams = chaine.split('&')
        var i = -1;
        while (tabparams[++i]) {
            tabitems = tabparams[i].split('=')
            if (myjson[decodeURIComponent(tabitems[0])] !== undefined) {
                if (myjson[decodeURIComponent(tabitems[0])] instanceof Array) {
                    myjson[decodeURIComponent(tabitems[0])].push(decodeURIComponent(tabitems[1]))
                } else {
                    myjson[decodeURIComponent(tabitems[0])] = [myjson[decodeURIComponent(tabitems[0])], decodeURIComponent(tabitems[1])]
                }
            } else {
                myjson[decodeURIComponent(tabitems[0])] = decodeURIComponent(tabitems[1]);
            }
        }
        return myjson;
    }

    function show_pay_error(msg = '') {
        var error_div = $('#card-fields__processing-error');
        error_div.removeClass('hidden');
        error_div.find('.notice__text').html(msg);
        $('html, body').animate({
            scrollTop: $("#card-fields__processing-error").offset().top - 50
        }, 500);
        $('.loading').hide();
    }

    function set_validation(id = '', excepArray = []) {
        var $form = $('form' + id),
            $select = $form.find('select');
        $input = $form.find('input'),
            $inputs = $.merge($select, $input);
        window.error = true;
        $($inputs).each(function(i, $input) {
            if ($.inArray($($input).attr('name'), excepArray) === -1) {
                $('#error-' + $($input).attr('id')).remove();
                if ($($input).val() == "" && !$($input).hasClass('visually-hidden')) {
                    $($input).css('border-color', 'red').attr('required', 'true');
                    $($input).after('<div style= "color:red;" id="error-' + $($input).attr('id') + '">Please fill this field.</div>');
                    window.error = false;
                }
            }
        });
        return window.error;
    }

    function ClearCookies() {
        var cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            var eqPos = cookie.indexOf("=");
            var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        }
    }
    if (!AC('cookies_cleared') || AC('cookies_cleared') != 'cleared') {
        ClearCookies();
        SC({
            'cookies_cleared': 'cleared'
        });
    }

    function get(url, callback, type = 'json', error) {
        $.ajax({
            url: url,
            type: 'get',
            dataType: type
        }).done(callback).fail(error);
    }

    function get_auth(url, callback, type = 'json', error) {
        $.ajax({
            url: url,
            type: 'get',
            dataType: type
        }).done(callback).fail(error);
    }

    function post(url, data, callback, type = 'json', error) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            dataType: type
        }).done(callback).fail(error);
    }

    function post_auth(url, data, callback, type = 'json', error) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            dataType: type
        }).done(callback).fail(error);
    }
    $(document).ready(function($) {
        var CD = {
            baseurl: BaseURL,
            currency: window.Shopify.currency.active,
            shop: window.Shopify.shop,
            cart: JSON.parse(localStorage.cart),
            shippingCountry: $('#checkout_shipping_address_country'),
            shippingState: $('#checkout_shipping_address_province'),
            billingCountry: $('#checkout_billing_address_country'),
            billingState: $('#checkout_billing_address_province'),
            stripe: '',
            card: '',
            style: {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    },
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        };
        if (AC('login') == "false") {
            var shopcookie = deserialize(AC(CD.shop));
            if (shopcookie != '') {
                var fields = {
                    '#checkout_email': 'checkout[email]',
                    '#checkout_shipping_address_first_name': 'checkout[shipping_address][first_name]',
                    '#checkout_shipping_address_last_name': 'checkout[shipping_address][last_name]',
                    '#checkout_shipping_address_company': 'checkout[shipping_address][company]',
                    '#checkout_shipping_address_address1': 'checkout[shipping_address][address1]',
                    '#checkout_shipping_address_address2': 'checkout[shipping_address][address2]',
                    '#checkout_shipping_address_city': 'checkout[shipping_address][city]',
                    '#checkout_shipping_address_country': 'checkout[shipping_address][country]',
                    '#checkout_shipping_address_province': 'checkout[shipping_address][province]',
                    '#checkout_shipping_address_zip': 'checkout[shipping_address][zip]',
                    '#checkout_shipping_address_phone': 'checkout[shipping_address][phone]',
                };
                for (field_id in fields) {
                    var field_val = shopcookie[fields[field_id]];
                    (field_val != '' ? $(field_id).val(field_val) : $(field_id).val(''));
                }
            }
        }
        if (typeof $_GET('status') != 'undefined' && $_GET('status') == 'payment_failed') {
            show_pay_error('Something went wrong, please try again.')
        }
        if (!CD.cart.requires_shipping) {
            $('#continue_button_shipping span').text('Continue to payment method');
            $('.return_to_shipping_method').html('<svg focusable="false" aria-hidden="true" class="icon-svg icon-svg--color-accent icon-svg--size-10 previous-link__icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10">\
<path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4"></path>\
</svg> Return to customer information');
            DC(['shipping_rate']);
            $('.total-line.total-line--shipping').remove();
            SC({
                shippingPrice: 0
            });
            $('.shipping-review').remove();
            $('.breadcrumb li:eq( 2 )').remove();
        }

        function return_to_shipping() {
            SC({
                presentPage: 'shipping_method'
            });
            var shippingMethod = AC('shippingHtml');
            $('#shipping_methods').html(shippingMethod);
            radioInputChange($('.totalPrice').val());
            order_summary();
            $('#' + AC('shippingId')).click();
            $('.shipping_method').show();
            $('.customer_info').hide();
            $('.payment_method').hide();
            formFontColor('#737373', '#333333', '#737373');
        }

        function return_to_custmr_info() {
            SC({
                presentPage: 'customer_info'
            });
            $('.shipping_method').hide();
            $('.customer_info').show();
            $('.payment_method').hide();
            formFontColor('#333333', '#737373', '#737373');
        }

        function radioInputChange() {
            $('.radio_input').change(function() {
                if ($(this).prop('checked') == true) {
                    var id = $(this).attr('id'),
                        price3 = $(this).attr('size'),
                        discount_price = parseInt(AC('discountPrice')),
                        shipping_rate = JSON.parse(AC('shipping_rate')),
                        total2 = (parseInt(CD.cart.total_price) + parseInt(shipping_rate[id].price * 100)) - discount_price;
                    $('#Shipping_price').html(price3);
                    $('#total_price').html(Shopify.formatMoney(total2));
                    $('#total-recap__final-price').html(Shopify.formatMoney(total2));
                    SC({
                        shippingPrice: shipping_rate[id].price * 100,
                        totalPrice: Shopify.formatMoney(total2),
                        totalPriceInput: total2,
                        shippingId: id
                    });
                }
            })
        }

        function formFontColor(color1, color2, color3) {
            $('.breadcrumb__item--current').css('color', color1);
            $('.breadcrumb__item--completed').css('color', color2);
            $('.breadcrumb__item--blank').css('color', color3);
        }

        function shipping_payment_method() {
            var html1 = $("input[name='shipping_rate']:checked").val();
            var html2 = $("input[name='shipping_rate']:checked").attr('size');
            var html = html1 + ' ' + '<span>' + html2 + '</span>';
            $('#shipping_methd').html(html);
            order_summary();
        }

        function getSates(country_elem, state_elem) {
            var id = country_elem.children("option:selected").attr('data-id');
            get_auth(CD.baseurl + 'Checkout/GetStateList?country_id=' + id, function(data) {
                state_elem.html(data);
                if (AC('login') == "false") {
                    var shopcookie = deserialize(AC(CD.shop));
                    if (shopcookie != '') {
                        state_elem.val(shopcookie['checkout[shipping_address][province]']);
                    }
                } else {
                    state_elem.val(AC('shippingState'));
                }
            }, 'html');
        }

        function getDiscounthtml(applied_text, data) {
            var total_html = $(data).find('.total-line--reduction'),
                discountPrice = $(total_html).find('.total-line__price span:first').attr('data-checkout-discount-amount-target'),
                discountrow = $(data).find('.total-line--reduction').html(),
                tag_list = $(data).find('.tags-list').html();
            if (!discountPrice) {
                var discountedSubtotal = $(data).find('.total-line__price:first span').attr('data-checkout-subtotal-price-target');
                discountPrice = CD.cart.original_total_price - parseInt(discountedSubtotal);
            }
            $('.product-table').html($(data).find('.product-table').html());
            $('.total-line-table').html($(data).find('.total-line-table').html());
            $('#checkout_reduction_code').val(applied_text.trim().split('(')[0].trim());
            $('#discoint_price').val(discountPrice);
            $('.total-line--reduction').html(discountrow);
            $('.tags-list').html(tag_list);
            $('.reduction-code').prepend('<i class="fa fa-tags" aria-hidden="true"></i>').find('svg').remove();
            $('.tag__button').prepend('<i class="fa fa-times" aria-hidden="true"></i>').find('svg').remove();
            $('.tags-list,.total-line--reduction').show();
            $('#discount_code_error').hide();
            SC({
                discountPrice: discountPrice,
                discount_code: applied_text.trim().split('(')[0].trim(),
                discountPriceValue: Shopify.formatMoney(discountPrice) * (-1)
            });
            order_summary();
            $(".tag__button").click(function(e) {
                e.preventDefault();
                var $form = $(this).parents('form'),
                    url = $form.attr('action'),
                    data = $form.serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    dataType: 'json',
                }).always(function() {
                    SC({
                        discountPrice: 0,
                        discount_code: '',
                        discountPriceValue: ''
                    });
                    location.reload()
                });
            });
            $(".tag__button").mouseover(function() {
                $(this).css('color', '#717171');
            });
        }

        function get_discount_code_html(code) {
            get("/checkout", function(data) {
                $('.loading_button').hide();
                $('.total-recap__original-price').show();
                $('#discount_button').css('background-color', '#c8c8c8');
                $('.visually-hidden-on-mobile').show();
                $('.icon-svg').show();
                var applied_text = $(data).find('.reduction-code__text').html();
                applied_text = applied_text.trim().split('(')[0].trim()
                if (applied_text && code.toUpperCase() == applied_text) {
                    getDiscounthtml(applied_text, data);
                } else {
                    SC({
                        discountPrice: 0
                    });
                    $('#discount_code_error').show();
                }
            }, 'html');
        }

        function default_discount() {
            $('.loading_discount_code').show();
            get("/checkout", function(data) {
                $('.total-recap__original-price').show();
                $('.loading_discount_code').hide();
                var applied_text = $(data).find('.reduction-code__text').html();
                if (applied_text) {
                    getDiscounthtml(applied_text, data)
                } else {
                    SC({
                        discountPrice: 0
                    });
                }
            }, 'html');
        }

        function order_summary() {
            var P = {
                    discountPrice: parseInt(AC('discountPrice')),
                    total_price: parseInt(CD.cart.total_price),
                    shippingPrice: parseInt(AC('shippingPrice'))
                },
                shipping_price = (!P.shippingPrice || isNaN(P.shippingPrice) ? 0 : P.shippingPrice),
                discountPrice = (!P.discountPrice || isNaN(P.discountPrice) ? 0 : P.discountPrice),
                total = P.total_price + shipping_price - discountPrice;
            $('#total_price,#total-final-price').html(Shopify.formatMoney(total));
            if (!isNaN(P.shippingPrice)) {
                $('#Shipping_price').html((shipping_price == 0 ? 'Free' : Shopify.formatMoney(shipping_price)));
                $('#shipping_price_input').val(shipping_price);
            }
            return total;
        }

        function countryList(country_elem) {
            get_auth(CD.baseurl + "Checkout/GetCountyList", function(data) {
                country_elem.html(data);
                if (AC('login') == "false") {
                    var shopcookie = deserialize(AC(CD.shop));
                    if (shopcookie != '') {
                        (deserialize(AC(CD.shop)['checkout[shipping_address][country]']) != '' ? $('#checkout_shipping_address_country').val(deserialize(AC(CD.shop)['checkout[shipping_address][country]'])) : $('#checkout_shipping_address_country').val(''));
                    }
                }
            }, 'html');
        }

        function reset_validation() {
            var $form = $('form.edit_checkout_customer_info'),
                $inputs = $form.find('input');
            $($inputs).keydown(function() {
                if ($(this).val() != "") {
                    $(this).css('border-color', '#d9d9d9');
                    $('#error-' + $(this).attr('id')).remove();
                }
            });
        }

        function reset_validation_billing() {
            var $form = $('form#billing_address'),
                $inputs = $form.find('input');
            $($inputs).keydown(function() {
                if ($(this).val() != "") {
                    $(this).css('border-color', '#d9d9d9');
                }
            });
        }

        function get_shipping_rate() {
            $('.loading,.shipping_method_loader').show();
            var zip = $('#checkout_shipping_address_zip').val(),
                country = (!AC('shippingCountry') ? CD.shippingCountry.val() : AC('shippingCountry')),
                state = (!AC('shippingState') ? CD.shippingState.val() : AC('shippingState')),
                cartTotal = parseInt(CD.cart.total_price),
                query = "shipping_address[zip]=" + zip + "&shipping_address[country]=" + country + "&shipping_address[province]=" + state;
            get("/cart/shipping_rates.json?" + query, function(response) {
                $('.loading,.shipping_method_loader').hide();
                if (response.shipping_rates) {
                    var html = "",
                        first_ship = response.shipping_rates[0];;
                    $(response.shipping_rates).each(function(index, rates) {
                        var price1 = 0,
                            price = 'Free';
                        if (rates.price > 0) {
                            price = Shopify.formatMoney(rates.price);
                            price1 = rates.price;
                        }
                        html += '<div class="content-box__row">';
                        html += '<div class="radio-wrapper" data-shipping-method="shopify-Standard%20shipping%202-8%20days%20with%20UPS-0.00">'
                        html += '<div class="radio__input">';
                        html += '<input ' + (index == 0 ? 'checked="checked"' : '') + ' class="radio_select input-radio radio_input" size="' + price + '" price="' + price1 * 100 + '" name="shipping_rate" id="' + index + '" value="' + rates.name + '" shipping_value="' + rates.name + '<span>' + price + '<span>" type="radio">';
                        html += '</div>';
                        html += '<label class="radio__label" aria-hidden="true" for="' + index + '">';
                        html += '<span class="radio__label__primary" data-shipping-method-label-title="Standard shipping 2-8 days with UPS">' + rates.name + '</span>';
                        html += '<span class="radio__label__accessory"><span class="content-box__emphasis">' + price + '</span>';
                        html += '</span></label></div></div>';
                    });
                    $('#shipping_methods').html(html);
                }
                if ($('#checkout_remember_me').is(':checked')) {
                    var shopcookie = {};
                    shopcookie[CD.shop] = JSON.stringify($('.edit_checkout_customer_info').serialize());
                    SC(shopcookie)
                }
                var total = order_summary();
                SC({
                    shipping_rate: JSON.stringify(response.shipping_rates),
                    shippingPrice: first_ship.price,
                    presentPage: 'shipping_method',
                    shippingHtml: $('#shipping_methods').html(),
                    shippingCountry: country,
                    totalPriceInput: total,
                    shippingState: state
                });
                radioInputChange(cartTotal);
                $('.shipping_method').show();
                $('.customer_info').hide();
                formFontColor('#737373', '#333333', '#737373');
                $('.error_shipping').hide();
                setAddresses();
            }, 'json', function(e) {
                $('.loading').hide();
                $('.error_shipping').show();
                if (e.responseJSON.zip) {
                    $('.error_shipping').html('zip ' + e.responseJSON.zip);
                }
            });
        }

        function getcart() {
            $('.loading').show();
            custodata = {};
            custodata['billing_address'] = $('form#billing_address').serialize();
            custodata['customer_info'] = $('form.edit_checkout_customer_info').serialize();
            custodata['shipping_method'] = $('form.shipping_method_form').serialize();
            if (AC('discount_code') != "") {
                get_discount_price(custodata);
            } else {
                create_draft_order('', custodata);
            }
        }

        function get_discount_price(custodata) {
            var code = AC('discount_code');
            $('.loading_button').show();
            get("/checkout", function(data) {
                $('.loading_button,.loading').hide();
                var total_html = $(data).find('.total-line__price span[data-checkout-discount-amount-target]'),
                    applied_text = $(data).find('.reduction-code__text').html(),
                    discountPrice = 0;
                applied_text = applied_text.trim().split('(')[0].trim()
                if (applied_text != undefined && code == applied_text) {
                    var _discount = $(total_html[0]).attr('data-checkout-discount-amount-target');
                    if (_discount) {
                        discountPrice = parseInt(_discount) / 100;
                    } else {
                        var discountedSubtotal = $(data).find('.total-line__price:first span').attr('data-checkout-subtotal-price-target');
                        discountPrice = (CD.cart.original_total_price - parseInt(discountedSubtotal)) / 100;
                    }
                }
                create_draft_order(discountPrice, custodata);
            }, 'html');
        }

        function create_draft_order(discountPrice, custodata) {
            $('.loading').show();
            var id = $("input[name='shipping_rate']:checked").attr('id');
            var data1 = {
                shop_domain: CD.shop,
                customer_data: custodata,
                cart_data: JSON.stringify(CD.cart),
            };
            if (AC('shipping_rate')) {
                data1['shippingPrice'] = JSON.parse(AC('shipping_rate'))[id].price;
            }
            if (discountPrice > 0) {
                data1['discountPrice'] = discountPrice;
                data1['coupenCode'] = AC('discount_code');
            }
            post_auth(CD.baseurl + 'Checkout/createDraftOrder?shop='+shopsdt.shop, data1, function(response) {
                if (response.code == 200) {
                    var orderId = response.draft_order.draft_order.id;
                    var gateway = $("input[name='payment_gateway']:checked").val();
                    var data2 = {
                        gateway: gateway,
                        orderId: orderId,
                        shop_domain: CD.shop,
                        complete_data: data1
                    };
                    paymentGateway(data2);
                } else {
                    $('.loading').hide();
                    show_pay_error(response.msg)
                }
            });
        }

        function paymentGateway(data) {
            var gateway = data.gateway,
                shop_domain = data.shop_domain,
                amount = order_summary(),
                orderId = data.orderId;
            switch (gateway) {
                case 'card':
                    card_payment(shop_domain, orderId, amount);
                    break;
                case 'alipay':
                    alipay(shop_domain, orderId, amount);
                    break;
                case 'bancontact':
                    PaymentMethod('bancontact', shop_domain, orderId, amount);
                    break;
                case 'eps':
                    PaymentMethod('eps', shop_domain, orderId, amount);
                    break;
                case 'giropay':
                    PaymentMethod('giropay', shop_domain, orderId, amount);
                    break;
                case 'ideal':
                    PaymentMethod('ideal', shop_domain, orderId, amount);
                    break;
                case 'multibanco':
                    PaymentMethod('multibanco', shop_domain, orderId, amount);
                    break;
                case 'p24':
                    PaymentMethod('p24', shop_domain, orderId, amount);
                    break;
                case 'sofort':
                    SOFORT(shop_domain, orderId, amount);
                    break;
                case 'paypal':
                    data.url = CD.baseurl + 'Checkout/create_payment_with_paypal';
                    other_methods(data);
                    break;
                case 'trustly':
                    data.url = CD.baseurl + 'Checkout/payment_with_trustly';
                    other_methods(data);
                    break;
            }
        }

        function other_methods(data) {
            var data1 = {
                draft_order_id: data.orderId,
                shop: data.complete_data.shop_domain,
                total_amount: order_summary(),
                cart_data: data.complete_data.cart_data,
                currency: CD.currency,
            };
            post_auth(data.url, data1, function(response) {
                if (response.code == 200) {
                    window.location.href = response.redirect_url;
                } else {
                    show_pay_error(response.message)
                }
            });
        }

        function card_payment(shop_domain, orderId, amount) {
            $('.loading').show();
            var data = {
                'orderId': orderId,
                'shop': CD.shop,
                'amount': amount,
                'type': 'token',
                'currency': CD.currency
            };
            CD.stripe.createToken(CD.card).then(function(result) {
                if (result.token) {
                    data.source = result.token.id;
                    post_auth(CD.baseurl + 'Checkout/checkPaymentStatus?shop=' + CD.shop, data, function(response) {
                        if (response.code == 200) {
                            if (parseInt(response.amt) > 0) {
                                // CD.stripe.handleCardPayment(response.data.client_secret, CD.card, ).then(function(e) {
                                    // if (e.paymentIntent) {
                                        // if (e.paymentIntent.status == 'succeeded') {
                                            post_auth(CD.baseurl + 'Checkout/createOrder?shop=' + CD.shop, {
                                                order_id: orderId
                                            }, function(e) {
                                                if (e.redirect_url) {
                                                    window.location.href = e.redirect_url;
                                                }
                                            });
                                        // } else {
                                        //     show_pay_error('Something went wrong')
                                        // }
                                //     } else {
                                //         show_pay_error('Something went wrong')
                                //     }
                                // });
                            } else {
                                post_auth(CD.baseurl + 'Checkout/createOrder?shop=' + CD.shop, {
                                    order_id: orderId
                                }, function(e) {
                                    if (e.redirect_url) {
                                        window.location.href = e.redirect_url;
                                    }
                                });
                            }
                        } else {
                            window.location.href = response.redirect_url;
                        }
                    });
                } else {
                    show_pay_error(result.error.message)
                }
            });
        }

        function PaymentMethodeResult(result) {
            var id = result.source.id;
            var status = result.source.status;
            window.location.href = result.source.redirect.url;
        }

        function alipay(shop_domain, orderId, amount) {
            $('.loading').show();
            CD.stripe.createSource({
                type: 'alipay',
                amount: amount,
                currency: CD.currency,
                redirect: {
                    return_url: CD.baseurl + 'Home/checkPaymentStatus?orderId=' + orderId + '&shop=' + CD.shop + '&amount=' + amount + '&type=source&currency=' + CD.currency,
                },
            }).then(function(result) {
                PaymentMethodeResult(result);
            });
        }

        function PaymentMethod(gateway, shop_domain, orderId, amount) {
            $('.loading').show();
            CD.stripe.createSource({
                type: gateway,
                amount: amount,
                currency: CD.currency,
                redirect: {
                    return_url: CD.baseurl + 'Home/checkPaymentStatus?orderId=' + orderId + '&shop=' + CD.shop + '&amount=' + amount + '&type=source&currency=' + CD.currency,
                },
                owner: {
                    name: CD.name,
                    email: CD.email,
                },
            }).then(function(result) {
                PaymentMethodeResult(result);
            });
        }

        function SOFORT(shop_domain, orderId, amount) {
            $('.loading').show();
            CD.stripe.createSource({
                type: 'sofort',
                amount: amount,
                currency: CD.currency,
                redirect: {
                    return_url: CD.baseurl + 'Home/checkPaymentStatus?orderId=' + orderId + '&shop=' + CD.shop + '&amount=' + amount + '&type=source&currency=' + CD.currency,
                },
                sofort: {
                    country: 'IT',
                },
            }).then(function(result) {
                PaymentMethodeResult(result);
            });
        }

        function setAddresses() {
            var plus = ',';
            var address1 = $('#checkout_shipping_address_address1').val() + plus;
            var pin = $('#checkout_shipping_address_zip').val() + plus;
            var city = $('#checkout_shipping_address_city').val() + plus;
            $('.review-block__content_email').html($('#checkout_email').val());
            var address2 = ($('#checkout_shipping_address_address2').val() != "" ? $('#checkout_shipping_address_address2').val() + plus : "");
            var company = ($('#checkout_shipping_address_company').val() != "" ? $('#checkout_shipping_address_company').val() + plus : "");
            $('.review-block__content_address').html(company + address1 + address2 + pin + city + AC('shippingState') + plus + AC('shippingCountry'));
        }

        function selectPaymentmethod() {
            if ($("input[name='payment_gateway']:checked").val() == 'card') {
                $('#card_payment').show();
            } else {
                $('#card_payment').hide();
            }
        }

        function billing_address_input() {
            if ($('.biling_address').prop('checked') == true) {
                $('#section--billing-address__different').show();
                countryList(CD.billingCountry)
            } else {
                $('#section--billing-address__different').hide();
            }
        }

        function createPaymentHTML(card) {
            var html = '',
                provider_data = JSON.parse(AC('provider_data'));
            $(provider_data).each(function(index, radio) {
                html += '<div class="radio-wrapper content-box__row " data-gateway-group="direct" data-select-gateway=' + radio.provider_name + '>';
                html += '<div class="radio__input"><input class="input-radio payment_gateway" id="' + radio.provider_name + '" type="radio" value="' + radio.provider_name + '" ' + (index === 0 ? 'checked="checked"' : '') + ' name="payment_gateway"></div>';
                html += '<div class="radio__label  ">';
                html += '<label for="' + radio.provider_name + '" class="radio__label__primary content-boheightx__emphasis"> ' + (radio.provider_name != 'card' ? '<img class="' + radio.provider_name + '" alt=' + radio.provider_name + ' height="24px" src="' + CD.baseurl + 'assets/images/' + radio.provider_image + '">' : 'Credit card') + '</label>';
                if (radio.provider_name == "card") {
                    html += '<span class="radio__label__accessory">';
                    html += '<span data-brand-icons-for-gateway=' + radio.provider_name + '>';
                    html += '<span class="payment-icon payment-icon--visa" data-payment-icon="visa"></span>';
                    html += '<span class="payment-icon payment-icon--master" data-payment-icon="master"></span>';
                    html += '<span class="payment-icon payment-icon--american-express" data-payment-icon="american-express"></span>';
                    html += '</span></span>';
                }
                html += '</div>';
                html += '<div id="payment_gateway_26453508169_description" class="visually-hidden" aria-live="polite" data-detected="Detected card brand: {brand}"></div></div>';
                if (radio.provider_name == "card") {
                    html += '<div id="card_payment">'
                    html += '<div class="form-row">';
                    html += '<label for="card-element">Credit or debit card</label>';
                    html += '<div id="card-element"></div>';
                    html += '<div id="card-errors" role="alert"></div>';
                    html += '</div></div>';
                }
                $('.offsite-payment-gateway-logo').attr('src', CD.baseurl + radio.provider_image);
            });
            $('.payment_method_radio_input').html(html);
            card.mount('#card-element');
            CD.card_elem = card;
        }

        function showCurrentStep(step) {
            var steps = ['shipping_method', 'customer_info', 'payment_method'];
            for (var i = 0; i < steps.length; i++) {
                step == steps[i] ? $('.' + steps[i]).show() : $('.' + steps[i]).hide();
            }
        }
        //Continue to Shipping
        $('#continue_button_shipping').click(function(e) {
            var status = set_validation('.edit_checkout_customer_info', ['checkout[shipping_address][company]', 'checkout[shipping_address][address2]']);
            if (!status) return false;
            if (CD.cart.requires_shipping) {
                get_shipping_rate();
            } else {
                setAddresses();
                SC({
                    presentPage: 'payment_method'
                });
                showCurrentStep('payment_method');;
                formFontColor('#737373', '#737373', '#333333');
                order_summary();
            }
        });
        $('.return_to_shipping_method').click(function() {
            if (CD.cart.requires_shipping) {
                return_to_shipping()
            } else {
                return_to_custmr_info()
            }
        });
        $('#continue_button_payment').click(function() {
            SC({
                presentPage: 'payment_method'
            });
            shipping_payment_method();
            showCurrentStep('payment_method')
            formFontColor('#737373', '#737373', '#333333')
        });
        $("#discount_code_form").submit(function(e) {
            e.preventDefault();
            $('.visually-hidden-on-mobile,.icon-svg').hide();
            $('#discount_button').css('background-color', '#c1b381');
            $('.loading_button').show();
            var code = $('#checkout_reduction_code').val();
            $.ajax({
                url: "/discount/" + code,
                type: 'get',
                dataType: 'html',
                success: function(data_discount) {
                    //             SC({discount_code: code})
                    get_discount_code_html(code);
                }
            });
        });
        get_auth(CD.baseurl + "Checkout/getData?shop=" + CD.shop, function(_data) {
            var presentPage = AC('presentPage');
            if (!presentPage || AC('login') == "false") presentPage = "customer_info";
            CD.stripe = Stripe(_data.stripe_key);
            CD.name = _data.name;
            CD.email = _data.email;
            var elements = CD.stripe.elements();
            CD.card = elements.create('card', {
                hidePostalCode: true,
                style: CD.style
            });
            CD.card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                displayError.textContent = (event.error ? event.error.message : '');
            });
            SC({
                provider_data: JSON.stringify(_data.provider_data)
            });
             createPaymentHTML(CD.card);
            CD.shippingCountry.html(_data.countries).promise().done(function() {
                if (AC('login') == "false") {
                    var shopcookie = deserialize(AC(CD.shop));
                    if (shopcookie != '') {
                        CD.shippingCountry.val(shopcookie['checkout[shipping_address][country]']);
                    }
                } else {
                    CD.shippingCountry.val(AC('shippingCountry'));
                }
                getSates(CD.shippingCountry, CD.shippingState);
            });
            //Check if by default Discount applied
            default_discount();
            showCurrentStep(presentPage);
            if (presentPage == "payment_method") {
                $('#shipping_methd').html(AC('shippingMethode'));
                $('#shipping_methods').html(AC('shippingHtml'));
                if (AC('shippingId') && $('#' + AC('shippingId')).length) {
                    $('#' + AC('shippingId')).click();
                }
                formFontColor('#737373', '#737373', '#333333');
                shipping_payment_method();
            } else if (presentPage == "shipping_method") {
                formFontColor('#737373', '#333333', '#737373');
                get_shipping_rate();
            } else if (presentPage == "customer_info") {
                check_login();
                formFontColor('#333333', '#737373', '#737373');
                $('#shipping_methods').html(AC('shippingHtml'));
            }
            selectPaymentmethod();
            reset_validation();
            reset_validation_billing();
            setAddresses();
            billing_address_input();
            $('.loading').hide();
            $('.order-summary-toggle').click(function() {
                $('.js .order-summary--is-collapsed,.order-summary-toggle__text--show,.order-summary-toggle__text--hide').toggle();
            })
            $(".payment_gateway").change(function() {
                selectPaymentmethod();
            })
            CD.shippingCountry.change(function() {
                getSates(CD.shippingCountry, CD.shippingState);
                localStorage.shipping_country = CD.shippingCountry.val();
                SC({
                    shippingCountry: CD.shippingCountry.val()
                });
            })
            CD.shippingState.change(function() {
                SC({
                    shippingState: CD.shippingState.val()
                });
            })
            CD.billingCountry.change(function() {
                getSates(CD.billingCountry, CD.billingState);
            })
            $('.link_small_ship').click(function() {
                SC({
                    presentPage: 'shipping_method'
                });
                $('.shipping_method').show();
                $('.customer_info').hide();
                $('.payment_method').hide();
                radioInputChange($('.totalPrice').val());
            });
            $('.return_to_custmr_info,.link_small').click(function() {
                SC({
                    presentPage: 'customer_info'
                });
                $('.shipping_method').hide();
                $('.customer_info').show();
                $('.payment_method').hide();
                formFontColor('#333333', '#737373', '#737373');
            });
            $('#complete_payment').click(function(e) {
                e.preventDefault();
                if ($('.biling_address').prop('checked') == true) {
                    var status = set_validation('#billing_address', ['checkout[billing_address][company]', 'checkout[billing_address][address2]']);
                }
                getcart();
            });
            $("input[type='radio'][name='checkout[different_billing_address]']").click(function() {
                billing_address_input();
                countryList(CD.billingCountry);
            });
        });
    });
})
