async function editRow(studentId, fname, lname, prog, email, acadyr) {

const f = fname
const l = lname
const p = prog




// $('#myModal').on('shown.bs.modal', function () {
//   $('#myInput').trigger('focus')
// })



// const { value: firstName } = await Swal.fire({
//   title: 'Enter your IP address',
//   input: 'text',
//   inputValue: f,

//   input: 'text',
//   inputValue: l,
//   showCancelButton: true,
//   inputValidator: (value) => {
//     if (!value) {
//       return 'You need to write something!'
//     }
//   }
// })




	

// const { value: formValues } = await Swal.fire({
//   title: 'Edit Student Data' + " " + studentId + " " + fname,
//   html:
//     '<input id="fname" class="swal2-input">' +
//     '<input id="lname" class="swal2-input">'+
//     '<input id="prog" class="swal2-input">'+
//     '<input id="email" class="swal2-input">'+
//     '<input id="acadyr" class="swal2-input">'+
//     '<input id="campus" class="swal2-input">',

//   focusConfirm: false,
//   preConfirm: () => {
//     return [
//       document.getElementById('fname').value,
//       document.getElementById('lname').value,
//       document.getElementById('prog').value,
//       document.getElementById('email').value,
//       document.getElementById('acadyr').value,
//       document.getElementById('campus').value
//     ]
//   }
// })

// if (formValues) {
//   Swal.fire(JSON.stringify(formValues))
// }

}



   


// function editRowPass() {
// 	jQuery.ajax({
//     type: "POST",
//     url: './engine/heart.php',
//     dataType: 'json',
//     data: {functionname: 'edit', arguments: [1, 2]},

//     success: function (obj, textstatus) {
//                   if( !('error' in obj) ) {
//                       yourVariable = obj.result;
//                   }
//                   else {
//                       console.log(obj.error);
//                   }
//             }
// });
// }