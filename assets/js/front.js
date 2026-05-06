jQuery(document).ready(function() {

    // Clear all signature pads after form is sent
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        jQuery('.dscf7_signature').each( function(){
            var dsname  = jQuery(this).find(".digital_signature-pad").attr("name");
            var bgcolor  = jQuery(this).find(".digital_signature-pad").attr("backcolor");
            var pencolor = jQuery(this).find(".digital_signature-pad").attr("color");

            var dsPad = new SignaturePad(document.getElementById("digital_signature-pad_" + dsname), {
                backgroundColor: bgcolor,
                penColor: pencolor,
            });

            dsPad.clear();
            jQuery("input[name=" + dsname + "]").val("");
        });
    }, false );

    // Initialise every signature pad on the page
    jQuery('.dscf7_signature').each( function(){
        var current            = jQuery(this);
        var dsname             = current.find(".digital_signature-pad").attr("name");
        var signaturepadheight = current.find(".digital_signature-pad").attr("height");
        var signaturepadwidth  = current.find(".digital_signature-pad").attr("width");
        var bgcolor            = current.find(".digital_signature-pad").attr("backcolor");
        var pencolor           = current.find(".digital_signature-pad").attr("color");
        var canvas             = document.getElementById("digital_signature-pad_" + dsname);

        canvas.setAttribute("height", signaturepadheight);
        canvas.setAttribute("width",  signaturepadwidth);

        var dsPad = new SignaturePad(canvas, {
            backgroundColor: bgcolor,
            penColor: pencolor,
        });

        canvas.addEventListener('touchstart', captureSignature, false);
        canvas.addEventListener('touchend',   captureSignature, false);
        canvas.addEventListener('click',      captureSignature, false);

        function captureSignature(event) {
            if (event.handled === false) return;
            event.stopPropagation();
            event.preventDefault();
            event.handled = true;
            jQuery("input[name=" + dsname + "]").val(dsPad.toDataURL('image/png'));
        }

        current.find(".clearButton").on('click', function(){
            dsPad.clear();
            jQuery("input[name=" + dsname + "]").val("");
        });
    });
});
