Mautic.disabledSqlConditionsActions = function(opener) {
    if (typeof opener == 'undefined') {
        opener = window;
    }
    var email = opener.mQuery('#campaignevent_properties_sql').val();

    var disabled = email === '' || email === null;

    opener.mQuery('#campaignevent_properties_editButton').prop('disabled', disabled);
};

Mautic.standardSqlConditionsUrl = function(options) {

    if (!options) {
        return;
    }

    var url = options.windowUrl;
    if (url) {
        var editKey = '/sqlConditions/edit/objectId';
        if (url.indexOf(editKey) > -1) {
            options.windowUrl = url.replace('objectId', mQuery('#campaignevent_properties_sql').val());
        }
    }

    return options;
};
