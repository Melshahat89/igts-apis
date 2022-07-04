$(document).ready(function() {
    $('.select2-input').select2();

});


function loadWidget(URL, ID = '', SECTION = '')
{   

    $.ajax({
        type:'GET',
        url: '/lazyadmin' + URL + ID + '?section_id=' + SECTION,
        dataType: "html",
        async: false,
        cache: false,
        success: function(response)
        {
            $('#modalBody').html("");
            $('#modalBody').append(response);
        }
    });

    return true;
}

function AddNewchoice() {     
    let i = document.querySelectorAll('.choice').length + 1;
      
    
    $.ajax({

      type: 'GET',
      url: '/lazyadmin/quizquestions/addInput/' + i,

      success: function(data){

        console.log(data);
        $('#laraflat-choice').append(data);
      }
    });
           
  }
function removechoice(e, item = null) {

    if(item) {

        $.ajax({

            type: 'GET',
            url: '/lazyadmin/quizquestionschoice/' + item + '/delete',

            success: function(data){

            }

        });
    }
    $(e).closest("div.choice").remove();
}
function clearAllchoice(e) {
    $("#laraflat-choice").html("");
}

listenToCostInputs();

function addNewCourseItem(){

    let tBody = $('#offlineorders-table-body');
    let i = document.querySelectorAll('.courseitem').length + 1;

    $.ajax({

        type: 'GET',
        url: '/lazyadmin/orders/addCourseItem/',

        success: function(data){
            
            tBody.append(
                "<tr class='courseitem'><td class='no'>" + i + "</td><td class='text-left'><h3>" + data + "</h3></td>"
                + "<td class='unit'>1</td><td class='qty'><a class='button btn-danger'><span onclick='removeItem(this)' class='btn bg-deep-purple btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></span></a></td><td class='total'><input class='cost-input' required type='number' name='coursesCost[]'></td></tr>"
            )

            listenToCostInputs();
        }

    });

}

function addNewCertificateItem(){

    let tBody = $('#offlineorders-table-body');
    let i = document.querySelectorAll('.courseitem').length + 1;
    let existingCertSelect = document.querySelector('.certificates');

    if(!existingCertSelect){
        $.ajax({

            type: 'GET',
            url: '/lazyadmin/orders/addCertificateItem/',
    
            success: function(data){
                
                tBody.append(
                    "<tr class='courseitem'><td class='no'>" + i + "</td><td class='text-left'><h3>" + data + "</h3></td>"
                    + "<td class='unit'>1</td><td class='qty'><a class='button btn-danger'><span onclick='removeItem(this)' class='btn bg-deep-purple btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></span></a></td><td class='total'><input class='cost-input' required type='number' name='certificates-cost'></td></tr>"
                )
    
                listenToCostInputs();
                $('.certificates').multiSelect(search("Certificates"));
            }
    
        });
    
    }else{
        alert('Certificates Selection Is Already Initialized');
    }
    

}

function removeItem(e){
    $(e).closest("tr.courseitem").remove();
    calculateGrandTotal();
}

function listenToCostInputs(){

    costInputs = document.querySelectorAll('.cost-input');

    costInputs.forEach(function(input){
        input.addEventListener('change', (e) => {  
            calculateGrandTotal();
        });
    });
}

function calculateGrandTotal(){

    let total = 0;
    var costInputs = document.querySelectorAll('.cost-input');

    costInputs.forEach(function(input){
        if(input.value !== ""){
            total += parseFloat(input.value);
        }
    });


    $('#grand-total').html(total);
    $('#grand-total-input').val(total);

}

