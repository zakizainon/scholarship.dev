function fnShowPopup(messageText, alertType){
    $.notify({
            title: '<strong>YTI Scholarship</strong>',
            message: '<br />'+ messageText +'<br />'
        },
        {
            element: 'body',
            allow_dismiss: true,
            type: alertType,
            placement: {
                from: "top",
                align: "center"
            },
            template: ' <div data-notify="container" class="col-xs-11 col-sm-4 alert alert-{0}" role="alert" style="margin: 15px 0 15px 0; width: 450px; opacity: 0.5;">' +
            '               <button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;</button>' +
            '               <span data-notify="icon"></span> <span data-notify="title">{1}</span> ' +
            '               <span data-notify="message">{2}</span>' +
            '               <div class="progress" data-notify="progressbar">' +
            '                   <div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '               </div>' +
            '               <a href="{3}" target="{4}" data-notify="url"></a>' +
            '           </div>'
        });
}