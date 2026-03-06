<style>
    .my-table{
        position: unset;
        transform: unset;
        width: 100%;
        height: unset;
    }
</style>

<div class="">
    <table class="table table-bordered my-table">
        <thead>
            <th>S.No</th>
            <th>Date</th>
            <th>Opening Time</th>
            <th>Closing Time</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php if(!empty($master_timelines)) :?>
            <?php foreach($master_timelines as $index => $timeline) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= date('d-m-Y', strtotime($timeline['date'])) ?></td>
                    <td><?= $timeline['opening_time'] ?></td>
                    <td><?= $timeline['closing_time'] ?></td>
                    <td>
                        <div class="form-group">
                            <input type="checkbox" class="" name="mymovieevent[]" value="<?= $timeline['master_timeline_id'] ?>" placeholder="Check" style="height:26px; width:26px;" />
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No events found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>