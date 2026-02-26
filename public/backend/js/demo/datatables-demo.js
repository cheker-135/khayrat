// Set French defaults for DataTables globally
if (typeof jQuery !== 'undefined' && jQuery.fn.dataTable) {
  jQuery.extend(true, jQuery.fn.dataTable.defaults, {
    "language": {
      "emptyTable": "Aucune donnée disponible dans le tableau",
      "info": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
      "infoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
      "infoFiltered": "(filtré à partir de _MAX_ éléments au total)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Afficher _MENU_ éléments",
      "loadingRecords": "Chargement...",
      "processing": "Traitement...",
      "search": "Rechercher :",
      "zeroRecords": "Aucun élément correspondant trouvé",
      "paginate": {
        "first": "Premier",
        "last": "Dernier",
        "next": "Suivant",
        "previous": "Précédent"
      },
      "aria": {
        "sortAscending": ": activer pour trier la colonne par ordre croissant",
        "sortDescending": ": activer pour trier la colonne par ordre décroissant"
      },
      // Backward compatibility for older versions
      "sEmptyTable": "Aucune donnée disponible dans le tableau",
      "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
      "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
      "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
      "sInfoPostFix": "",
      "sInfoThousands": ",",
      "sLengthMenu": "Afficher _MENU_ éléments",
      "sLoadingRecords": "Chargement...",
      "sProcessing": "Traitement...",
      "sSearch": "Rechercher :",
      "sZeroRecords": "Aucun élément correspondant trouvé",
      "oPaginate": {
        "sFirst": "Premier",
        "sLast": "Dernier",
        "sNext": "Suivant",
        "sPrevious": "Précédent"
      },
      "oAria": {
        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
      }
    }
  });
}

// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable();
});


