var register = (function (self) {
    self.error = null;
    self.hint = null;
    self.hasErrors = false;
    self.init = function (e, h, t) {
        self.error = e;
        self.hint = h;
        $.each(t, function (id, content) {
            $("#" + id).popover({
                trigger: 'focus',
                placement: 'bottom',
                content: content
            });
        });
        self.show();
    };
    self.checkInputs = function (inputs) {
        $.each(inputs, function (i, id) {
            var val = $('#' + id).val();
            if (val === '' || val === '0') {
                self.error[id] = self.hint[id];
                self.hasErrors = true;
            }
        });
        return self;
    };
    self.checkInputGroup = function (inputs, group) {
        $.each(inputs, function (i, id) {
            var val = $('#' + id).val();
            if (val === '' || val === '0') {
                self.error[group] = self.hint[group];
                self.hasErrors = true;
            }
        });
        return self;
    };
    self.show = function () {
        $('span[id^="error-"]').addClass('hidden').closest('.form-group').removeClass('has-error');
        $.each(self.error, function (i, val) {
            $('#error-' + i).removeClass('hidden').text(val);
            $('#error-' + i).closest('.form-group').addClass('has-error');
        });

    };
    self.wasError = function () {
        self.error = {};
        self.hasErrors = false;

        $('.form-group').removeClass('has-success');

        self.checkInputs(['family', 'firstname', 'lastname', 'city', 'status', 'email', 'phone', 'password', 'company', 'position', 'institut', 'faculty'])
            .checkInputGroup(['day', 'month', 'year'], 'birthday')
            .checkInputGroup(['w_start_month', 'w_start_year'], 'w_start_date')
            .checkInputGroup(['w_end_month', 'w_start_year'], 'w_end_date')
            .checkInputGroup(['e_start_month', 'e_start_year'], 'e_start_date')
            .checkInputGroup(['e_end_month', 'e_start_year'], 'e_end_date')
            .show();

        $('.form-group:not(".has-error")').addClass('has-success');

        return self.hasErrors;
    };
    return self;
})(register || {});

function init(errors, hint, tips) {
    register.init(errors, hint, tips);
}

function checkForm() {
    return !register.wasError();
}