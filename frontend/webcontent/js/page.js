$(document).ready(function () {
    $('#lockAll').click(function () {
        Page.closeStaticPopup();
    });
});
var Page = {};
Page.openStaticPopup = function (popupID) {
    $('#lockAll').stop(true, true).css({ 'height': $(document).height(), 'width': $(document).width() }).show();
    $(popupID).stop(true, true).fadeIn(100).addClass('opened');
    $("html, body").animate({ scrollTop: 0 }, "slow");
}

Page.closeStaticPopup = function () {
    if ($('.popup.opened').length > 0) {
        $('.popup.opened').fadeOut(100).removeClass('opened');
        $('#lockAll').hide();
        $('.formError').remove();
    }
}

Page.showPopup = function (params) {
    var popupParams = {
        Centered: true,
        Top: '25%',
        Left: '50%',
        Width: 'auto',
        Height: 'auto',
        Position: '',
        Title: '',
        Content: '',
        CloseOnLock: false,
        lockThrough: false,
        wrapperId: '',
        wrapperClass: '',
        CloseIcon: false,
        additionalClass: '',
        BtnOk: {
            isVisible: true,
            Title: 'OK',
            CSSClass: 'custom-btn',
            Icon: '',
            CloseOnClick: true,
            ShowLoader: false,
            onClick: null
        },
        BtnCancel: {
            isVisible: false,
            Title: 'Cancel',
            CSSClass: 'custom-btn',
            Icon: '',
            CloseOnClick: true,
            onClick: null
        },
        AfterClose: null
    };
    $.extend(true, popupParams, params);
    var classStr = '';
    if(popupParams.additionalClass.length)
        classStr = ' class="'+popupParams.additionalClass+'"';

    var popupHTML = '<div id="customPopup"'+classStr+'>';
    if (popupParams.CloseIcon) {
        popupHTML += '<div class="icon-close" onclick="Page.closePopup();"></div>';
    }
    popupHTML += '<div class="wrapper ' + popupParams.wrapperClass + '" id="' + popupParams.wrapperId + '">';
    if (popupParams.Title != '') {
        popupHTML += '<div class="title">' + popupParams.Title + '</div>';
    }
    if (popupParams.Content != '') {
        popupHTML += '<div class="content">' + popupParams.Content + '</div>';
    }
    popupHTML += '<div class="btns-holder">';
    if (popupParams.BtnOk.isVisible) {
        popupHTML += '<a class="btn-ok ' + popupParams.BtnOk.CSSClass + '">' + popupParams.BtnOk.Title + '<ins><!--  --></ins></a><span class="btn-loader"><!--  --></span>';
    }
    if (popupParams.BtnCancel.isVisible) {
        popupHTML += '<a class="btn-cancel ' + popupParams.BtnCancel.CSSClass + '">' + popupParams.BtnCancel.Title + '<ins><!--  --></ins></a>';
    }
    popupHTML += '</div>';
    popupHTML += '<div class="closePopUp" onclick="Page.closePopup();"></div><span class="loader"></span></div></div>';

    var $lockAll = $('#lockAll');
    var $popup = $(popupHTML).insertAfter($lockAll);
    $lockAll.fadeIn(100).css('height', $(document).height());
    $popup.fadeIn(100);

    if (popupParams.Width != 'auto') {
        $popup.css({ 'width': popupParams.Width});
    }

    if (popupParams.Centered) {
        if (popupParams.Width == 'auto') {
            $popup.css({ 'margin-left': -$popup.width() / 2 });
        } else {
            $popup.css({ 'margin-left': -popupParams.Width / 2 });
        }
        if (popupParams.Height == 'auto') {
            $popup.css({ 'margin-top': -$popup.height() / 2 });
        } else {
            $popup.css({ 'margin-top': -popupParams.Height / 2 });
        }
    } else {
        $popup.css({ 'top': popupParams.Top, 'left': popupParams.Left });
    }

    if (typeof(popupParams.BtnOk.onClick) == 'function') {
        var $btnOk = $('.btn-ok', $popup);
        $btnOk.click(function () {
            if (popupParams.BtnOk.ShowLoader) {
                $('.btn-loader', $popup).css({ 'width': $btnOk.outerWidth(), 'display': 'inline-block' });
                $btnOk.hide();
            }
            popupParams.BtnOk.onClick()
        });
    }

    if (popupParams.BtnOk.CloseOnClick) {
        $('.btn-ok', $popup).click(closePopup);
    }

    if (typeof(popupParams.BtnCancel.onClick) == 'function') {
        $('.btn-cancel', $popup).click(popupParams.BtnCancel.onClick);
    }

    if (popupParams.BtnCancel.CloseOnClick) {
        $('.btn-cancel', $popup).click(closePopup);
    }

    if (popupParams.CloseOnLock) {
        $lockAll.one('click', closePopup);
    }

    $('#lockAll').stop(true, true).css({ 'height': $(document).height(), 'width': $(document).width() }).show();

    function closePopup() {
        $popup.fadeOut(100, function () {
            $popup.remove();
        });
        if (!popupParams.lockThrough) {
            $lockAll.fadeOut(100);
        }
        if (typeof(popupParams.AfterClose) == 'function') {
            setTimeout(popupParams.AfterClose, 100);
        }
    }

    $("html, body").animate({ scrollTop: 0 }, "slow");

}
Page.closePopup = function () {
    var $popup = $('#customPopup');
    $popup.fadeOut(100, function () {
        $popup.remove();
    });
    $('#lockAll').fadeOut(100);
}