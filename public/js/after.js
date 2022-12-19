// Sweet Alert
$(".swal-confrim").click(function (e) {
    id = e.target.dataset.id;
    Swal.fire({
        title: 'Apakah anda yakin ingin hapus data ini?',
        text: "Data yang terhapus tidak dapat dikembalikan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'

    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success',
            )
            $(`#delete${id}`).submit();
        } else {
        }
    })
});

// function searchTable() {
//     var input;
//     var saring;
//     var status;
//     var tbody;
//     var tr;
//     var td;
//     var i;
//     var j;
//     input = document.getElementById("input");
//     saring = input.value.toUpperCase();
//     tbody = document.getElementsByTagName("tbody")[0];;
//     tr = tbody.getElementsByTagName("tr");
//     for (i = 0; i < tr.length; i++) {
//         td = tr[i].getElementsByTagName("td");
//         for (j = 0; j < td.length; j++) {
//             if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
//                 status = true;
//             }
//         }
//         if (status) {
//             tr[i].style.display = "uuun";
//             status = false;
//         } else {
//             tr[i].style.display = "none";
//         }
//     }
// }


// Data Tables
// $("#table-abc").dataTable({
//     "columnDefs": [{
//         "sortable": false,
//         "targets": [2, 3]
//     }]
// });
// $("#table-abc").dataTable({
//     "columnDefs": [
//       { "sortable": false, "targets": [2,3] }
//     ]
//   });

// $("#table-user").dataTable({
//     "scrollX" : true,
//     "responsive" : true,
//     "autoWidth" : false,
//   "columnDefs": [
//     { "sortable": false, "targets": [2,3] }
//   ]
// });