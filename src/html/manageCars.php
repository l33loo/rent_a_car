<?php
require_once '../html/components/header.php';

echo getHeader();?>

<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 style="margin-top: 150px; margin-bottom:50px;">Manage Cars</h1>
        </div>
    </div>
    <div class="container">
        <table id="my_table_id" data-url="data/url.json" data-id-field="id"
            data-editable-emptytext="Default empty text." data-editable-url="/my/editable/update/path">
            <thead>
                <tr>
                    <th class="col-md-1" data-field="id" data-sortable="true" data-align="center">Cars</th>
                    <th class="col-md-4" data-field="name" data-editable="true">Brand</th>
                    <th class="col-md-7" data-field="description" data-editable="true"
                        data-editable-emptytext="Custom empty text.">Model</th>
                    <th class="col-md-7" data-field="description" data-editable="true"
                        data-editable-emptytext="Custom empty text.">Plate</th>

                </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript">
    </script>
</body>

</html>