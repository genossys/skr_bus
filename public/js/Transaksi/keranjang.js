
var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/getDataKeranjang',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, sortable: false },
        { data: 'urlFoto', name: 'urlFoto' },
        { data: 'namaProduct', name: 'namaProduct' },
        { data: 'qty', name: 'qty' },
        { data: 'kdSatuan', name: 'kdSatuan' },
        { data: 'hargaJual', name: 'hargaJual' },
        { data: 'subtotal', name: 'subtotal' },
        { data: 'action', name: 'action', searchable: false, orderable: false }
    ],
    columnDefs: [
        {
            targets: [5,6],
            className: 'text-right'
        },
        {
            targets: [0,1,3,4,7],
            className: 'text-center'
        },
    ],
    footerCallback: function (row, data, start, end, display) {
        var api = this.api(), data;

        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
            return typeof i === 'string' ?
                i.replace('.', '') * 1 :
                typeof i === 'number' ?
                i : 0;
        };

        // Total over all pages
        total = api
            .column(6)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Total over this page
        pageTotal = api
            .column(4, {
                page: 'current'
            })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        numeral.register('locale','idr',{
            delimiters:{
                thousands: '.',
                decimal: ','
            },
            
        });
        numeral.locale('idr');
        var totalString = numeral(total).format('0,0.00');
        $('#totalKeranjang').html(
            'Rp. '+totalString
        );
    }

});