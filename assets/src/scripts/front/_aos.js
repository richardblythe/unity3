/** Vendor: AOS */
import AOS from 'aos';

jQuery( document ).ready(function() {
    if ( typeof unity3 != "undefined" ) {
        AOS.init( unity3.aos.init );
    }
});