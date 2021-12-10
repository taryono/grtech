/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    cache: false
});
Array.prototype.inArray = function(value) {
    var i;
    for (i = 0; i < this.length; i++) {
        if (this[i] == value) {
            return true;
        }
    }
    return false;
};

var app = {
    rupiah: function rupiah(bilangan) {
        var number_string = bilangan.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return "Rp. " + rupiah;
    },
    number: function number(bilangan) {
        var number_string = bilangan.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? ',' : '';
            rupiah += separator + ribuan.join(',');
        }
        return rupiah;
    },
    uppercase: function touppercase(element) {
        var str = $(element).val().toLowerCase();
        var lowercase = (str + '').replace(/^(.)|\s+(.)/g, function($1) {
            return $1.toUpperCase()
        });
        $(element).val(lowercase);
    },
    test: function test(element) {
        var str = $(element).val().toLowerCase();
        var test = (str + '').replace(/\b\w/g, function($1) {
            return $1.toUpperCase()
        });
        $(element).val(test);
    },
    idrFormat: function rupiah(bilangan) {
        var number_string = bilangan.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return "IDR. " + rupiah + ".00";
    },
    numberOnly: function numberOnly(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

        if ($(e).val() < 0 || isNaN($(e).val())) {
            $(e).val(0);
        }

    },
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var size = input.files[0].size;
        var extensions = ["jpeg", "png", "jpg", "gif", "svg"];
        var img = $('div.post-review img').attr('src');
        if (extensions.indexOf(getFileExtension(input.files[0].name.toLowerCase())) != -1) {
            if (size > 2048000) {
                alert('Maksimal size 2MB');
                reader.onload = function(e) {
                    $('.post-review img').attr('src', img).css({"width":"300px"});
                }
            } else {
                reader.onload = function(e) {
                    $('.post-review img').attr('src', e.target.result).css({"width":"300px"});
                }
            }
        } else {
            alert('Ekstension File not allowed ' + getFileExtension(input.files[0].name.toLowerCase()));
            reader.onload = function(e) {
                $('.post-review img').attr('src', img).css({"width":"300px"});
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(function() {
    $("input.post-input").change(function() {
        readURL(this);
    });
});

$(".amount").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A, Command+A
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }

    if ($(this).val() < 0 || isNaN($(this).val())) {
        $(this).val(0);
    }
});

function getFileExtension(filename) {
    return filename.split('.').pop();
}