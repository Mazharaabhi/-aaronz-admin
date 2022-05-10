// Class definition
var KTSelect2 = function() {
    // Private functions
    var demos = function() {
        // basic
        $('#kt_select2_1, #kt_select2_1_validate, #kt_select2_2').select2({
            placeholder: "Select a state"
        });

        $('#icon').select2({
            placeholder: "Select an icon"
        });

        $('#location_id').select2({
            placeholder: "Property Location"
        });


        $('#lead_for').select2({
            placeholder: "select Lead For"
        });

        $('#news_category_id').select2({
            placeholder: "Select news category"
        });

        $('#service_category_id').select2({
            placeholder: "Select service category"
        });

        $('#document_type_id').select2({
            placeholder: "Select document type"
        });

        $('#service_sub_category_id').select2({
            placeholder: "Select service sub category"
        });

        // $('#location_id').select2({
        //     placeholder: "Select location"
        // });

        $('#property_status_id').select2({
            placeholder: "Select Property Status"
        });

        $('#is_commercial').select2({
            placeholder: "Property Type"
        });

        $('#nationality').select2({
            placeholder: "Select nationality"
        });

        $('#price_id').select2({
            placeholder: "Select property price"
        });

        $('#size_sqft').select2({
            placeholder: "Select property size"
        });

        $('#size_sqmt').select2({
            placeholder: "Select property size"
        });

        $('#agent_id').select2({
            placeholder: "Select agent"
        });

        $('#rent_frequency').select2({
            placeholder: "Select rent frequency"
        });

        $('#expire_after').select2({
            placeholder: "Select expire after"
        });

        $('#bed_no').select2({
            placeholder: "Select bedrooms"
        });

        $('#bath_no').select2({
            placeholder: "Select bathrooms"
        });

        $('#state_id, #prop_location_state_id').select2({
            placeholder: "Select satate"
        });

        $('#area_id, #prop_location_area_id').select2({
            placeholder: "Select area"
        });

        $('#menu_id').select2({
            placeholder: "Select a menu"
        });

        $('#langs').select2({
            placeholder: "Select agent languages"
        });

        $('#prop_state_id').select2({
            placeholder: "Select city"
        });

        $('#specialities').select2({
            placeholder: "Select agent specialities"
        });

        $('#prop_parent_id').select2({
            placeholder: "Select property parent"
        });

        $('#prop_type_id').select2({
            placeholder: "Select property type"
        });

        $('#type_id').select2({
            placeholder: "Property for"
        });

        $('#size_id').select2({
            placeholder: "Property Size"
        });

        $('#property_tenure').select2({
            placeholder:"Property tenure"
        });

        $('#financial_status').select2();
        $('#xml_portal').select2();

        $('#occupacy_id').select2({
            placeholder:"select occupacy"
        });

        $('#availablity_id').select2({
            placeholder:"select availability"
        });

        $('#view_id').select2({
            placeholder: "Select view"
        });

        $('#developer_id').select2({
            placeholder: "Select developer"
        });

        $('#service_id').select2({
            placeholder: "Select a category"
        });

        $('#company_id, #edit_company_id').select2({
            placeholder: "select a company"
        });
        $('#country').select2({
            placeholder: "select a country"
        });
        $('#state').select2({
            placeholder: "select a state"
        });

        // nested
        $('#email_category_id').select2({
            placeholder: "select email category"
        });

        $('#category_id').select2({
            placeholder: "select property category"
        });

        // multi select
        $('#kt_select2_3, #kt_select2_3_validate').select2({
            placeholder: "Select a state",
        });

        // basic
        $('#kt_select2_4').select2({
            placeholder: "Select a state",
            allowClear: true
        });

        // loading data from array
        var data = [{
            id: 0,
            text: 'Enhancement'
        }, {
            id: 1,
            text: 'Bug'
        }, {
            id: 2,
            text: 'Duplicate'
        }, {
            id: 3,
            text: 'Invalid'
        }, {
            id: 4,
            text: 'Wontfix'
        }];

        $('#kt_select2_5').select2({
            placeholder: "Select a value",
            data: data
        });

        // loading remote data

        function formatRepo(repo) {
            if (repo.loading) return repo.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";
            if (repo.description) {
                markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
            }
            markup += "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
                "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                "</div>" +
                "</div></div>";
            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }

        $("#kt_select2_6").select2({
            placeholder: "Search for git repositories",
            allowClear: true,
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        // custom styles

        // tagging support
        $('#kt_select2_12_1, #kt_select2_12_2, #kt_select2_12_3, #kt_select2_12_4').select2({
            placeholder: "Select an option",
        });

        // disabled mode
        $('#kt_select2_7').select2({
            placeholder: "Select an option"
        });

        // disabled results
        $('#kt_select2_8').select2({
            placeholder: "Select an option"
        });

        // limiting the number of selections
        $('#kt_select2_9').select2({
            placeholder: "Select an option",
            maximumSelectionLength: 2
        });

        // hiding the search box
        $('#kt_select2_10').select2({
            placeholder: "Select an option",
            minimumResultsForSearch: Infinity
        });

        // tagging support
        $('#kt_select2_11').select2({
            placeholder: "Add a tag",
            tags: true
        });

        // disabled results
        $('.kt-select2-general').select2({
            placeholder: "Select an option"
        });
    }

    var modalDemos = function() {
        $('#kt_select2_modal').on('shown.bs.modal', function () {
            // basic
            $('#kt_select2_1_modal').select2({
                placeholder: "Select a state"
            });

            // nested
            $('#kt_select2_2_modal').select2({
                placeholder: "Select a state"
            });

            // multi select
            $('#kt_select2_3_modal').select2({
                placeholder: "Select a state",
            });

            // basic
            $('#kt_select2_4_modal').select2({
                placeholder: "Select a state",
                allowClear: true
            });
        });
    }

    // Public functions
    return {
        init: function() {
            demos();
            modalDemos();
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    KTSelect2.init();
});
