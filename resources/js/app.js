import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        toastr.success(notification.msg)
        let count = $('.dropdown .badge-counter').data('count')
        if(count < 5){
            $('.dropdown .badge-counter').removeClass('d-none')
            $('.dropdown .badge-counter').data('count', (count + 1))
            $('.dropdown .badge-counter').text( count + 1 )
        }else{
            $('.dropdown .badge-counter').data('count', (count + 1))
            $('.dropdown .badge-counter').text('5*')
        }
});
$('dropdown badge-counter').lenght
// console.log($('.dropdown .badge-counter').text())
// console.log($('.dropdown .badge-counter').data('count'))
// let count = $('.dropdown .badge-counter').data('count')
// if(count < 5){
//     console.log($('.dropdown .badge-counter').data('count', count + 1))
// }else{
//     console.log($('.dropdown .badge-counter').data('count', count + 1))
// }
