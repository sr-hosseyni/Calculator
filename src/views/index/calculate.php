<section id="policy-table">
    <div class="container">
        <table class="calculate">
            <thead>
                <tr>
                    <th></th>
                    <th>Policy</th>
                    <?php if ($policy->getInstalmentsNumber() > 1): ?>
                        <?php for ($i = 1; $i <= $policy->getInstalmentsNumber(); $i++): ?>
                            <th><?= $i ?> instalment</th>
                        <?php endfor; ?>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Value</th>
                    <td><?= $policy->getCarValue() ?></td>
                    <?php if ($policy->getInstalmentsNumber() > 1): ?>
                        <?php for ($i = 1; $i <= $policy->getInstalmentsNumber(); $i++): ?>
                            <td></td>
                        <?php endfor; ?>
                    <?php endif ?>
                </tr>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <th><?= $row['title'] ?></th>
                        <?php foreach ($row['value'] as $col): ?>
                            <td><?= sprintf('%.2f', $col) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>