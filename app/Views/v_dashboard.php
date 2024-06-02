<div class="container mt-5">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <?php
        $labels = [];
        $data = [];

        foreach ($getData as $row) {
            $labels[] = $row->name_game;
            $data[] = isset($totalIncome[$row->id_game]) ? $totalIncome[$row->id_game] : 0;
        ?>

        <?php } ?>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-body">
                    <canvas id="combinedIncomeChart" style="max-height: 300px; max-width: 500px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Total Registered Users</h5>
                    <p><?= $totalUsers ?></p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5>Total Income</h5>
                    <?php
                    $totalIncomeAllGames = array_sum($totalIncome);
                    ?>
                    <p><?= 'Rp ' . number_format($totalIncomeAllGames, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        var labels = <?= json_encode($labels) ?>;
        var data = <?= json_encode($data) ?>;

        var combinedIncomeData = {
            labels: labels,
            datasets: [{
                label: 'Total Income',
                data: data,
                backgroundColor: '#4154f1',
                borderColor: '#4154f1',
                borderWidth: 1
            }]
        };

        var combinedIncomeChart = new Chart(document.getElementById('combinedIncomeChart'), {
            type: 'bar',
            data: combinedIncomeData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                }
            }
        });
    });
</script>