/**
 * Populates #filters-form selects with filtered values
 * @param {object} vehicles - object with filtered vehicles
 * @param {array} selectedFilters - array of filters previously selected
 */
function setOtherSelects(vehicles, selectedFilters) {
    var modelSelect = $('#model');
    var sizeSelect = $('#size');
    var yearSelect = $('#year');
    var years = [];
    var sizes = [];
    var models = [];

    resetSelects();

    vehicles.forEach(vehicle => {
        /* make models, years and sizes unique in array */
        if (models.indexOf(vehicle.bike_model) === -1 && vehicle.bike_model != null ) {
            models.push(vehicle.bike_model);
        }
        if (sizes.indexOf(vehicle.size) === -1 && vehicle.size != null ) {
            sizes.push(vehicle.size);
        }
        if (years.indexOf(vehicle.year) === -1 && vehicle.year != null ) {
            years.push(vehicle.year);
        }
    });

    models.sort().forEach(models => {
        modelSelect.append(
            '<option ' + (selectedFilters.includes(models.toString()) ? 'selected ' : '') + 'value="' + models + '">' + models + '</option>'
            );
    });

    sizes.sort((a, b) => a - b).forEach(size => {
        console.log(size)
        sizeSelect.append(
            '<option ' + (selectedFilters.includes(size.toString()) ? 'selected ' : '') + 'value="' + size + '">' + size + '</option>'
            );
    });

    years.sort().forEach(year => {
        console.log(year)
        yearSelect.append(
            '<option ' + (selectedFilters.includes(year.toString()) ? 'selected ' : '') + 'value="' + year + '">' + year + '</option>'
            );
    });
}

/**
 * Resets #filters-form selects to empty state
 */
function resetSelects() {
    $('#model').prop("disabled", false).empty().append('<option value="0">Any</option>');;
    $('#size').empty().append('<option value="0">Any</option>');
    $('#year').empty().append('<option value="0">Any</option>');
}

/**
 * Sedns data to the server using Ajax GET method
 * And handles the result
 *
 * @param {object} data - form data to be sent.
 * @param {string} url - target URL.
 */
function callAjax(data, url) {
    $.ajax({
        type: 'get',
        url: url,
        data: data,
        success : function(answer){
            if(answer !== 0){
                $('.search-results').empty().append(answer.html);
                setOtherSelects(answer.selectors, answer.selectedFilters)
            }
        },error: function(answer){
            console.log(answer.statusText);
        },
    });
}
