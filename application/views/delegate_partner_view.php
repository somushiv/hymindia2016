<div class="row">
    <?php if (isset($profile)) echo $profile; ?>

    <div class="col-xs-9 col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="main-title"> Delegate Partner </span>
                <span class="nav nav-pills pull-right packages-view-lnks">
                    <a class="label label-primary add" href="delegate_partner/register"> <span class="glyphicon glyphicon-plus"> </span> </a>
                </span>
            </div>
            <div class="table-responsive ">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sl.no</th>
                            <th>Name</th>
                            <th>Relationship</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php if ($partner_details): ?>
                            <?php foreach ($partner_details as $item): ?>
                                <tr>
                                    <td> <?php echo $i++; ?></td>
                                    <td> <?php echo $item->delegate_partner_name; ?> </td>
                                    <td><?php echo getRelationships($item->delagate_partner_rel); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="alert alert-danger text-center">No results found!!!</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='text-right'>
            <a href="/event_registration/list_event_register" class="label label-primary" role="button">Event Registration <i class="fa fa-share-square"></i></a>
        </div>
    </div>
</div>