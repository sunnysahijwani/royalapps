
// calculate amount function 
function calculateAmount(index) {


    var regHrsVal = parseFloat($('#regHrs_' + index).val());

    var amountVal = parseFloat($('#amount_' + index).val());

    var otHrsVal = parseFloat($('#otHrs_' + index).val());

    var otHrs2Val = parseFloat($('#otHrs2_' + index).val());

    var statHrsVal = parseFloat($('#statHrs_' + index).val());

    var sum = 0;

    if (amountVal == "" || isNaN(amountVal)) {

        $('#tottalAmount_' + index).val("");
        $('#regHrs_' + index).val("");
        $('#otHrs_' + index).val("");
        $('#otHrs2_' + index).val("");

    } else {
        if (regHrsVal != "" && (!isNaN(regHrsVal))) {
            sum = amountVal * regHrsVal;
        }

        if (otHrsVal != "" && (!isNaN(otHrsVal))) {
            sum = sum + (amountVal * 1.5 * otHrsVal);
        }

        if (otHrs2Val != "" && (!isNaN(otHrs2Val))) {
            sum = sum + (amountVal * 2 * otHrs2Val);
        }
        if (statHrsVal != "" && !(isNaN(statHrsVal))) {
            sum = sum + (amountVal * statHrsVal);
        }

        if (sum > 0) {

            $('#tottalAmount_' + index).val(sum.toFixed(2));
            
           

        } else {

            $('#tottalAmount_' + index).val(amountVal);


        }
        calculateWage(index);
      
    }


}

// calculate gross method
function calculateWage(index) {

    var totalAmount = $('#tottalAmount_' + index).val();

    var bonusVal = parseFloat($('#bonus_' + index).val());

    if (totalAmount == "" || isNaN(totalAmount)) {

        $('#bonus_' + index).val("");

    } else {

        if (bonusVal != "" && isNaN(bonusVal)) {
            bonusVal = 0;
        }
       
            var wages = parseFloat(totalAmount) + parseFloat(bonusVal);

            var vocationPay = wages*0.04;

            var  gross = parseFloat(wages) + parseFloat(vocationPay);

            $('#wages_' + index).val(wages.toFixed(2));
            $('#vocationPay_' + index).val(vocationPay.toFixed(2))
            $('#gross_' + index).val(gross.toFixed(2));
        
    }
}

function saveChanges(index,url){
    var csrftokenval=$('meta[name="csrf-token"]').attr('content');
    var type = $('#type_'+index).val();
    var gross = $('#gross_'+index).val();
    if(gross != undefined && gross != ""){
        $.ajax(
            {
                url: url,
                type: 'post',
                data: { type: type, gross: gross, index:index },
                headers: { 'X-CSRF-TOKEN': csrftokenval },
                success: function( data ) {

                    $('#tbody_'+index).replaceWith(data);
                    $(document).find('.expandtable').ExpandableTable('toggleRow');
                }
            }
        );
         
    }
}


// calculate final balance 
function calculateFinalBalance(index){
     var netTax = $('#net_'+index).val();
     var advance = $('#advance_'+index).val();
        var totalBalance = netTax-advance;
        if(totalBalance <= 0){
            totalBalance = netTax
        }
        $('#balance_'+index).val(parseFloat(totalBalance).toFixed(2));
  
}

$(document).ready(function () { 

    $(document).on('click','td',function(e){
        e.preventDefault();
        e.stopPropagation();
      
        
      });

     // expand table event
     $(document).on('click','.expandPlus',function(e){
        e.stopPropagation();
        // $(this).closest('.expandtable').ExpandableTable('toggleRow');
       
      });
     
      
    // allow only number to enter
    $(document).on('keydown', '.onlyNumberAllow', function (e) {

        if (isNaN(e.key) && e.key !== 'Backspace' && e.key !== 'Tab' && e.key != '.') {
            e.preventDefault();
        }
    });
     

});