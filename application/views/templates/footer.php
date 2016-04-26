
<div class="modal fade" id="profile-mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Profile</h4>
          </div>
          <div class="modal-body">
            <img  id="loader" class="center-block img-responsive" src="<?=base_url();?>css/assets/data_loader.gif" />
          </div>
        </div>
    </div>
</div>
<div class="modal fade" id="doc-tracking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Document Tracking</h4>
          </div>
          <div class="modal-body">
            <table id="doc-tracking-tbl" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th data-dynatable-column="DT_DocNo">Document No</th>
                  <th data-dynatable-column="DT_EntryDate">Entry Date</th>
                  <th data-dynatable-column="DT_Sender">Sender</th>
                  <th data-dynatable-column="DT_Location">Location</th>
                  <th data-dynatable-column="Position">Approver Position</th>                                
                  <th data-dynatable-column="ApprovedBy">Approver ID</th>
                  <th data-dynatable-column="DateApproved">Date Approved</th>
                  <th data-dynatable-column="DT_Status">Status</th>
                  <th data-dynatable-column="DT_Remarks">Remarks</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url()?>js/scripts.js<?= '?v='.uniqid() ?>""></script>
</body>
</html>