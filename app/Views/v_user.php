<!-- your_table_view.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- (head content seperti sebelumnya) -->
</head>

<body>
    <div class="d-flex align-items-end row">
        <div class="col-sm-12">
            <div class="card-body">
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                        <?= session('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom">
                        <h4><?php echo $title ?></h4>
                    </div>
                    <table id="myTable" class="table table-striped pt-3" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                                <th>COUNTRY</th>
                                <th>PHONE NUMBER</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getData as $row) : ?>
                                <tr>
                                    <td><?= $row->customer ?></td>
                                    <td><?= $row->email ?></td>
                                    <td><span class="password-mask"><?= str_repeat('*', strlen($row->password)); ?></span></td>
                                    <td><?= $row->country ?></td>
                                    <td><?= $row->phone_number ?></td>
                                    <td>
                                    <a href="<?= site_url('User/edit/' . $row->customer) ?>" class="btn btn-outline-primary" id="edit"><i class="ti ti-edit"></i></i></a>
                                        <a href="<?= site_url('User/delete/' . $row->customer) ?>" class="btn btn-outline-danger" id="delete"><i class="ti ti-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php echo form_open('User/update', 'id="modalForm"', ['onsubmit' => 'return validateFile();']); ?>
            
            <div class="modal-body">
                <!-- Additional fields -->
                <div class="mb-3">
                    <label for="customer" class="form-label">Username</label>
                    <input type="text" class="form-control" id="customer" name="customer" value="<?= old('customer') ?>" required readonly >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= old('email') ?>" required >
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?= old('password') ?>" required >
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?= old('country') ?>" required >
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= old('phone_number') ?>" required >
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" value="SIMPAN">Simpan</button>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

        });
        $(document).on('click', '#edit', function(e) {
                    e.preventDefault();
                    $link = $(this).attr('href');
                    $.ajax({
                        url: $link,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {

                            $.each(data, function(idx, val) {
                                $('[name="' + idx + '"]').val(val);
                            })
                            $('#modalForm').modal('show');
                            $('.modal-title').text('Ubah Data');
                            $('#modalForm form').attr('action', '<?php echo site_url('User/update') ?>');
                        }
                    })
                })
    </script>
</body>

</html>