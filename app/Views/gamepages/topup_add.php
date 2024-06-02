<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href=<?= base_url('Main/index') ?>>Home</a></li>
            <li>Top Up</li>
        </ol>
        <h2>Top Up Details</h2>

    </div>
</section><!-- End Breadcrumbs -->

<section id="portfolio-details" class="portfolio-details d-flex">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-3">
                <div>
                    <?php if (!empty($gameDetails)) : ?>
                        <h3><?= $gameDetails->name_game ?></h3>
                        <p>Top Up : <?= $gameDetails->top_up ?></p>
                    <?php endif; ?>

                </div>
                <div class="portfolio-details">
                    <div class=" align-items-center">
                        <?php if (!empty($gameDetails->file)) : ?>
                            <img src="<?= base_url('/assets/uploads/img/' . $gameDetails->file) ?>" alt="Game Image" width="250" height="250">
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <div class="col-lg-8">
                <div class="portfolio-info">
                    <h2>Add Transaction</h2>
                    <ul>
                        <?= form_open('Transaksi/submit', ['id' => 'formId']); ?>
                        <div class="form-group">
                            <label for="server_game" class="col-sm-2 control-label pt-2">ID Server</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="server_game" name="server_game" placeholder="Your ID Server Game" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer" class="col-sm-2 control-label pt-2">User</label>
                            <div class="col-sm-10">

                                <input type="text" class="form-control" id="customer" name="customer" value="<?= esc(session()->get('customer')) ?>" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_game" class="col-sm-2 control-label pt-2">Game</label>
                            <div class="col-sm-10">

                                <input type="text" class="form-control" id="name_game" name="name_game" value="<?= esc($gameDetails->name_game) ?>" readonly>

                                <input type="hidden" id="id_game" name="id_game" value="<?= esc($gameDetails->id_game) ?>">
                            </div>
                        </div>

                        <input type="hidden" id="id_transaksi" name="id_transaksi">

                        <div class="form-group">
                            <label for="quantity" class="col-sm-2 control-label pt-2">Quantity</label>
                            <div class="col-sm-10">
                                <!-- Ganti elemen button dengan elemen select -->
                                <select class="form-select" id="quantity" aria-label="Quantity" onchange="updateTotalPrice()">
                                    <!-- Menambahkan opsi langsung dalam elemen select -->
                                    <option value="40000">100 <?= $gameDetails->top_up ?> - Rp 40.000</option>
                                    <option value="70000">200 <?= $gameDetails->top_up ?> - Rp 70.000</option>
                                    <option value="220000">500 <?= $gameDetails->top_up ?> - Rp 220.000</option>
                                    <option value="1200000">2200 <?= $gameDetails->top_up ?> - Rp 1.200.000</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 pt-3">
                                <p>Price: <span id="totalLabel"></span></p>
                                <input type="hidden" id="totalInput" name="jumlah">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="metode" class="col-sm-2 control-label pt-2">Payment</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <button type="button" class="btn btn-outline-secondary metode-btn" data-bs-toggle="button" aria-pressed="false" autocomplete="off" onclick="selectMetode('PayPal', this)">
                                            <img src="<?= base_url() ?>assets-game/img/paypal.png" alt="PayPal" class="metode-icon" style="width: 50px; height: 50px;">
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary metode-btn" data-bs-toggle="button" aria-pressed="false" autocomplete="off" onclick="selectMetode('Dana', this)">
                                            <img src="<?= base_url() ?>assets-game/img/dana4.png" alt="Dana" class="metode-icon" style="width: 50px; height: 50px;">
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary metode-btn" data-bs-toggle="button" aria-pressed="false" autocomplete="off" onclick="selectMetode('OVO', this)">
                                            <img src="<?= base_url() ?>assets-game/img/ovo.png" alt="Ovo" class="metode-icon" style="width: 50px; height: 50px;">
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary metode-btn" data-bs-toggle="button" aria-pressed="false" autocomplete="off" onclick="selectMetode('Gopay', this)">
                                            <img src="<?= base_url() ?>assets-game/img/gopay.jpg" alt="Gopay" class="metode-icon" style="width: 50px; height: 50px;">
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary metode-btn" data-bs-toggle="button" aria-pressed="false" autocomplete="off" onclick="selectMetode('ShopeePay', this)">
                                            <img src="<?= base_url() ?>assets-game/img/sopepay.jpg" alt="Shopee Pay" class="metode-icon" style="width: 50px; height: 50px;">
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary metode-btn" data-bs-toggle="button" aria-pressed="false" autocomplete="off" onclick="selectMetode('BCA Mobile', this)">
                                            <img src="<?= base_url() ?>assets-game/img/bcam.png" alt="BCA Mobile" class="metode-icon" style="width: 50px; height: 50px;">
                                        </button>
                                    </div>
                                </div>
                                <!-- Hidden input field to store the selected payment method -->
                                <input type="hidden" id="selectedMetode" name="metode" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10 pt-3">
                                <button type="button" class="btn btn-primary" style="background-color: #012970; border-color: #012970;" onclick="submitForm()">
                                    PAYMENT
                                </button>
                            </div>
                        </div>



                        <?= form_close(); ?>
                    </ul>

                </div>

            </div>

        </div>
    </div>
</section><!-- End Portfolio Details Section -->
<!-- Validasi Modal-->
<div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validationModalLabel">Alert!!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Please fill Your ID Server and select the top-up amount and payment method before payment.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="thankYouModalLabel">Thank You for Purchase!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your purchase was successful. Thank you for choosing our service.
            </div>
        </div>
    </div>
</div>

<script>
    var topUpValue = '<?= $gameDetails->top_up ?>';

    function updateTotalPrice() {
        var quantitySelect = document.getElementById('quantity');
        var totalLabel = document.getElementById('totalLabel');
        var totalInput = document.getElementById('totalInput');

       
        var selectedQuantity = parseInt(quantitySelect.value);
        var selectedPrice = calculatePrice(topUpValue, selectedQuantity);

        totalLabel.textContent = `Rp ${selectedPrice}`;

        totalInput.value = selectedPrice;
    }

    function calculatePrice(topUp, quantity) {
       
        return quantity;
    }

    function selectMetode(metode, button) {
      
        document.getElementById('selectedMetode').value = metode;

       
        var buttons = document.querySelectorAll('.metode-btn');
        buttons.forEach(function(btn) {
            btn.classList.remove('active');
            btn.setAttribute('aria-pressed', 'false');
        });
        button.classList.add('active');
        button.setAttribute('aria-pressed', 'true');

      
        console.log('Selected Metode:', metode);
    }

    function submitForm() {
        var selectedQuantity = document.getElementById('totalInput').value;
        var selectedMetode = document.getElementById('selectedMetode').value;
        var serverGame = document.getElementById('server_game').value;

       
        if (!serverGame.trim()) {
           
            var validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
            validationModal.show();
            return; 
        }

        if (selectedQuantity && selectedMetode) {
           
            document.getElementById('formId').submit();

         
            var thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
            thankYouModal.show();
        } else {
           
            var validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
            validationModal.show();
        }
    }

    updateTotalPrice();
</script>