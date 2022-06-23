<?php
$d->reset();
$sql = "select id,ten$lang as ten,tenkhongdau,thumb,photo,masp,gia from #_product where hienthi=1 and type='san-pham' order by id desc ";
$d->query($sql);
$products = $d->result_array();
?>
<!-- Modal đặt phòng -->
<div class="modal fade" id="modalDatPhong" tabindex="-1" role="dialog" aria-labelledby="modalDatPhongLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDatPhongLabel" style="font-weight:600">Yêu cầu đặt phòng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.html" name="frm_datphong" id="frm_datphong" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="form-group">
                                <input class="form-control" type="text" id="ten_datphong" name="ten_datphong" value="" placeholder="<?= _hovaten ?>*" />
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="form-group">
                                <input class="form-control" type="text" id="dienthoai_datphong" name="dienthoai_datphong" value="" placeholder="<?= _dienthoai ?>*" />
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <input class="form-control" type="number" id="soluong_nguoi" name="soluong_nguoi" value="" min="1" placeholder="<?= _soluongnguoi ?>*" />
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <input class="form-control" type="datetime-local" id="ngay_datphong" name="ngay_datphong" value="" placeholder="<?= _ngaydatphong ?>*" />
                            </div>
                        </div>
                        <?php
                        if ($com == 'san-pham' && isset($_GET['id'])) {
                        ?>
                            <div class="col-12 ">
                                <div class="form-group">
                                    <input type="text" readonly="readonly" class="form-control" name="tenphong_datphong" id="tenphong_datphong" value="<?= $row_detail['ten']; ?>">
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-12 ">
                                <div class="form-group">
                                    <select class="form-control" name="tenphong_datphong" id="tenphong_datphong">
                                        <?php
                                        foreach ($products as $pro) {
                                        ?>
                                            <option value="<?= $pro['tenkhongdau'] ?>"><?= $pro['ten'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            ?>
                        <?php
                        }
                        ?>
                        <div class="col-12 ">
                            <div class="form-group">
                                <textarea name="noidung_datphong" id="noidung_datphong" style="height:auto" rows="3" class="form-control" placeholder="<?= _yeucaudatphong ?>*"><?= _yeucaudatphong ?></textarea>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="<?= $config['sitekey'] ?>"></div>
                                <small class="text-danger error_captcha"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="mybtn btn-secondary">Nhập lại</button>
                    <button type="submit" name="submit_datphong" id="submit_datphong" onclick="return sb_datphong()" class="mybtn btn-vang"><?=_gui?></button>
                </div>
        </div>
        <script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
        </form>
    </div>
</div>