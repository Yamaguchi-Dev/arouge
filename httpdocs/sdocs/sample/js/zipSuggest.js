
//jQuery(function () {
//  var zipObj = jQuery('.zipSuggest :input').get();
//
//  jQuery('.zipInput').on('input keyup blur',function () {
//    var zipcode = jQuery(zipObj[0]).val() + jQuery(zipObj[1]).val();
//    if (new String(zipcode).length != 7) return false;
//
//    jQuery.ajax({
//      url  : './js/zipcode/search.cgi',
//      type : 'get',
//      data : { z : zipcode },
//      success : function (text) {
//        var data = new String( text + '\t\t\t' ).split('\t');
//        jQuery(zipObj[2]).val( data[1] );
//        jQuery(zipObj[3]).val( data[2] + data[3]);
//        jQuery(zipObj[4]).val( data[4] );
//
//      }
//    }); // end ajax
//    return false;
//  }); // end keyup
//
//}); // end loadevent

jQuery(function () {
  var zipObj = jQuery('.zipSuggest :input').get();

  jQuery('#postal_btn').click(function () {
    var zipcode = jQuery(zipObj[0]).val() + jQuery(zipObj[1]).val();
    if (new String(zipcode).length != 7) return false;

    jQuery.ajax({
      url  : './js/zipcode/search.cgi',
      type : 'get',
      data : { z : zipcode },
      success : function (text) {
        var data = new String( text + '\t\t\t' ).split('\t');
        jQuery(zipObj[3]).val( data[1] );
        jQuery(zipObj[4]).val( data[2] + data[3]);
        jQuery(zipObj[5]).val( data[4] );

      }
    }); // end ajax
    return false;
  }); // end keyup

}); // end loadevent
