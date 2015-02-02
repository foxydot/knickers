<?php 
global $wpdb;
$plugin_url = preg_replace('@/lib/template@i','',plugin_dir_url(__FILE__));
$states = array('AL'=>"Alabama",
		'AK'=>"Alaska",
		'AZ'=>"Arizona",
		'AR'=>"Arkansas",
		'CA'=>"California",
		'CO'=>"Colorado",
		'CT'=>"Connecticut",
		'DE'=>"Delaware",
		'DC'=>"District Of Columbia",
		'FL'=>"Florida",
		'GA'=>"Georgia",
		'HI'=>"Hawaii",
		'ID'=>"Idaho",
		'IL'=>"Illinois",
		'IN'=>"Indiana",
		'IA'=>"Iowa",
		'KS'=>"Kansas",
		'KY'=>"Kentucky",
		'LA'=>"Louisiana",
		'ME'=>"Maine",
		'MD'=>"Maryland",
		'MA'=>"Massachusetts",
		'MI'=>"Michigan",
		'MN'=>"Minnesota",
		'MS'=>"Mississippi",
		'MO'=>"Missouri",
		'MT'=>"Montana",
		'NE'=>"Nebraska",
		'NV'=>"Nevada",
		'NH'=>"New Hampshire",
		'NJ'=>"New Jersey",
		'NM'=>"New Mexico",
		'NY'=>"New York",
		'NC'=>"North Carolina",
		'ND'=>"North Dakota",
		'OH'=>"Ohio",
		'OK'=>"Oklahoma",
		'OR'=>"Oregon",
		'PA'=>"Pennsylvania",
		'RI'=>"Rhode Island",
		'SC'=>"South Carolina",
		'SD'=>"South Dakota",
		'TN'=>"Tennessee",
		'TX'=>"Texas",
		'UT'=>"Utah",
		'VT'=>"Vermont",
		'VA'=>"Virginia",
		'WA'=>"Washington",
		'WV'=>"West Virginia",
		'WI'=>"Wisconsin",
		'WY'=>"Wyoming");

$all_venues = $wpdb->get_col("SELECT meta_value
    FROM $wpdb->postmeta WHERE meta_key = '_location_venue'" );
    $venue_values = array_unique($all_venues);
    asort($venue_values);
?>
<div class="meta_control">
    <div class="table">
        <div class="row">
            <div class="cell">
            <?php $metabox->the_field('venue'); ?>
                <label>Location Name</label>                    
                <input type="hidden" value="<?php $metabox->the_value(); ?>" id="venue_input" name="<?php $metabox->the_name(); ?>">
                <div class="input_container">
                    <select class="combobox2" id="venue_combobox">
                        <option></option>
                    <?php 
                    foreach($venue_values AS $lv){
                        $selected = $lv==$metabox->get_the_value()?' SELECTED':'';
                        print '<option value="'.$lv.'"'.$selected.'>'.$lv.'</option>
                        ';
                    }
                    ?>
                    </select>
               </div>
            </div>
        </div>
        
<?php while($mb->have_fields('address',1)): ?>
    <div class="row">
        <div class="cell">
        <?php $metabox->the_field('street'); ?>
        <label id="<?php $metabox->the_name(); ?>_label" for="<?php $metabox->the_name(); ?>">Street Address</label>
        <div class="input_container"><input type="text" value="<?php $metabox->the_value(); ?>" id="_street" name="<?php $metabox->the_name(); ?>"></div>
        </div>
    </div>
    <div class="row">
        <div class="cell">
        <?php $metabox->the_field('city'); ?>
        <label id="<?php $metabox->the_name(); ?>_label" for="<?php $metabox->the_name(); ?>">City</label>
        <div class="input_container"><input type="text" value="<?php $metabox->the_value(); ?>" id="_city" name="<?php $metabox->the_name(); ?>"></div>
        </div>
    </div>
    <div class="row">
        <div class="cell">
        <?php $metabox->the_field('state'); ?>
        <label id="<?php $metabox->the_name(); ?>_label" for="<?php $metabox->the_name(); ?>">State</label>
        <div class="input_container">
            <select id="_state" name="<?php $metabox->the_name(); ?>">
                <option value="">--SELECT--</option>
                <?php foreach($states AS $k =>$v){ ?>
                    <option value="<?php print $v; ?>"<?php print $metabox->get_the_value()==$v?' SELECTED':''?>><?php print $v; ?></option>
                <?php } ?>
            </select>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="cell">
        <?php $metabox->the_field('zip'); ?>
        <label id="<?php $metabox->the_name(); ?>_label" for="<?php $metabox->the_name(); ?>">Zip Code</label>
        <div class="input_container"><input type="text" value="<?php $metabox->the_value(); ?>" id="_zip" name="<?php $metabox->the_name(); ?>"></div>
        </div>
    </div>
    <div class="row">
        <div class="cell">
        <?php $metabox->the_field('lat'); ?>
        <label id="<?php $metabox->the_name(); ?>_label" for="<?php $metabox->the_name(); ?>">Latitude</label>
        <div class="input_container"><input type="text" value="<?php $metabox->the_value(); ?>" id="_lat" name="<?php $metabox->the_name(); ?>"></div>
        </div>
    </div>
    <div class="row">
        <div class="cell">
        <?php $metabox->the_field('lng'); ?>
        <label id="<?php $metabox->the_name(); ?>_label" for="<?php $metabox->the_name(); ?>">Longitude</label>
        <div class="input_container"><input type="text" value="<?php $metabox->the_value(); ?>" id="_lng" name="<?php $metabox->the_name(); ?>"></div>
        </div>
    </div>
<?php endwhile; ?>
</div>
</div>


<script>
jQuery(function($){
$.widget( "custom.combobox2", {
_create: function() {
this.wrapper = $( "<span>" )
.addClass( "custom-combobox" )
.insertAfter( this.element );
this.element.hide();
this._createAutocomplete(); 
this._createShowAllButton();
},
_createAutocomplete: function() {
var selected = this.element.children( ":selected" ),
value = selected.val() ? selected.text() : "";
this.input = $( "<input>" )
.appendTo( this.wrapper )
.val( value )
.attr( "title", "" )
.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
.autocomplete({
delay: 0,
minLength: 0,
source: $.proxy( this, "_source" )
})
.tooltip({
tooltipClass: "ui-state-highlight"
});
this._on( this.input, {
autocompleteselect: function( event, ui ) {
ui.item.option.selected = true;
this._trigger( "select", event, {
item: ui.item.option
});
},
autocompletechange: "_postToTextField"
});
},

_createShowAllButton: function() {
var input = this.input,
wasOpen = false;
$( "<a>" )
.attr( "tabIndex", -1 )
.attr( "title", "Show All Items" )
.tooltip()
.appendTo( this.wrapper )
.button({
icons: {
primary: "ui-icon-triangle-1-s"
},
text: false
})
.removeClass( "ui-corner-all" )
.addClass( "custom-combobox-toggle ui-corner-right" )
.mousedown(function() {
wasOpen = input.autocomplete( "widget" ).is( ":visible" );
})
.click(function() {
input.focus();
// Close if already visible
if ( wasOpen ) {
return;
}
// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
},
_source: function( request, response ) {
var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
response( this.element.children( "option" ).map(function() {
var text = $( this ).text();
if ( this.value && ( !request.term || matcher.test(text) ) )
return {
label: text,
value: text,
option: this
};
}) );
},
_postToTextField: function( event, ui ) {
    var value = this.input.val(),
    valueLowerCase = value.toLowerCase(),
    valid = false;
    this.element.children( "option" ).each(function() {
        if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            $('#venue_input').val(value).trigger('change');
            return false;
        } else {
            $('#venue_input').val(value).trigger('change');
        }
        });
},
_destroy: function() {
this.wrapper.remove();
this.element.show();
}
});

    $( ".combobox2" ).combobox2();
    $('#venue_input').change(function(){
        console.log("<?php print $plugin_url; ?>venue_address_ajax.php");
        //update address fields
        $.ajax({
            type: "POST",
            url: "<?php print $plugin_url; ?>venue_address_ajax.php",
            data: { venue: $(this).val() }
        })
            .done(function( json ) {
                var address = JSON && JSON.parse(json) || $.parseJSON(json);
                $('#_street').val(address.street);
                $('#_street_2').val(address.street2);
                $('#_city').val(address.city);
                $('#_state').val(address.state);
                $('#_zip').val(address.zip);
                $('#_lat').val(address.lat);
                $('#_lng').val(address.lng);
        });
    });
});

</script>