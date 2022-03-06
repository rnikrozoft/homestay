<div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="form-group">
                    <!-- <h5 class="modal-title mb-2" id="exampleModalLabel">สถิติการเข้าร่วมกิจกรรมนี้</h5> -->
                    <input type="hidden" name="id" id="id">
                    <select id="year" class="form-control form-control-sm">
                        <option value="">เลือกปี พ.ศ</option>
                    </select>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <canvas id="report-content" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>