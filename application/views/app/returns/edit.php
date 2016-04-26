<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?=$title?>
            <span class="dropdown pull-right">
				<a href="" class="dropdown-toggle function" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    Functions
                    <span class="caret"></span>
                </a>
              	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li><a href="">Save Returns</a></li>
                </ul>
              	<a class="cls-btn" href="<?= base_url("app/".$this->uri->segment(2)."/".$this->uri->segment(3))?>" >
                    Close
                </a>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <div id="data-container" class="container-fluid">
            <form class="form-horizontal page-form" role="form" class="container-fluid">
				<div class="row">
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Doc. No.:</label>
                        <div class="col-xs-7">
                            <p class="form-control-static">CSR-10001</p>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Doc. Date:</label>
                        <div class="col-xs-7">
                            <p class="form-control-static">3/11/16</p>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Company:</label>
                        <div class="col-xs-7">
                            <p class="form-control-static">KC </p>
                        </div>
                    </div>
				</div>
                <div class="row">
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Booth Area</label>
                        <div class="col-xs-7">
                            <p class="form-control-static">B1</p>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Issued To:</label>
                        <div class="col-xs-7">
                            <p class="form-control-static">[Cashier]</p>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Branch:</label>
                        <div class="col-xs-7">
                            <p class="form-control-static">SMMM</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Shift:</label>
                        <div class="col-xs-7">
                            <p class="form-control-static">Opening</p>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Status:</label>
                        <div class="col-xs-7">
                            <p class="form-control-static">Open</p>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <label class="control-label col-xs-5">Holiday:</label>
                        <div class="col-xs-7">
                            <div class="radio col-xs-6">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Yes
                                </label>
                            </div>
                            <div class="radio col-xs-6">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="details">Details</div>


            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#token_tab" role="tab" data-toggle="tab">Token</a></li>
                    <li role="presentation"><a href="#ticket_tab"  role="tab" data-toggle="tab">Ticket</a></li>
                    <li role="presentation"><a href="#ccf_tab"  role="tab" data-toggle="tab">Coin Change Fund</a></li>
                    <li role="presentation"><a href="#dc_tab"  role="tab" data-toggle="tab">Data Card</a></li>
                    <li role="presentation"><a href="#wt_tab"  role="tab" data-toggle="tab">Wrist Tag</a></li>
                    <li role="presentation"><a href="#socks_tab"  role="tab" data-toggle="tab">Socks</a></li>
                    <li role="presentation"><a href="#cb_tab"  role="tab" data-toggle="tab">Cash Breakdown</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="token_tab">
                        <table class="table table-striped table-hover table-bordered  table-condensed">
                            <thead>
                            <tr>
                                <th rowspan="2">+</th>
                                <th rowspan="2">Token Pack</th>
                                <th colspan="6">Issuance</th>
                                <th rowspan="2">Total</th>
                                <th colspan="6">Issued By</th>
                                <th rowspan="2">Returns</th>
                                <th rowspan="2">Sold Packs</th>
                                <th rowspan="2">Peso Sale</th>
                            </tr>
                            <tr>
                                <th scope="col">1st</th>
                                <th scope="col">2nd</th>
                                <th scope="col">3rd</th>
                                <th scope="col">4th</th>
                                <th scope="col">5th</th>
                                <th scope="col">6th</th>
                                <th scope="col">1st</th>
                                <th scope="col">2nd</th>
                                <th scope="col">3rd</th>
                                <th scope="col">4th</th>
                                <th scope="col">5th</th>
                                <th scope="col">6th</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td>Piso Token</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>3,000</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>300</td>
                                <td>2,700</td>
                                <td>13,500.00</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Piso Token</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>3,000</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>250</td>
                                <td>2,978</td>
                                <td>13,750.00</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Piso Token</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>3,000</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>250</td>
                                <td>2,978</td>
                                <td>13,750.00</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Piso Token</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>3,000</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>250</td>
                                <td>2,978</td>
                                <td>13,750.00</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Piso Token</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>3,000</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>250</td>
                                <td>2,978</td>
                                <td>13,750.00</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Piso Token</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>3,000</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>250</td>
                                <td>2,978</td>
                                <td>13,750.00</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Piso Token</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>500</td>
                                <td>3,000</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>[UserID]</td>
                                <td>250</td>
                                <td>2,978</td>
                                <td>13,750.00</td>
                            </tr>
                            <tr>
                                <td colspan="17" style="text-align: right"><strong>Total:</strong></td>
                                <td><strong>96,000.00</strong></td>
                            </tr>
                            </tbody>
                        </table>


                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#piso_token_tab" role="tab" data-toggle="tab">Piso Token</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="piso_token_tab">
                                <table class="table table-striped table-hover table-bordered  table-condensed">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">+</th>
                                        <th rowspan="2">Token Pack</th>
                                        <th colspan="6">Issuance</th>
                                        <th rowspan="2">Total</th>
                                        <th colspan="6">Issued By</th>
                                        <th rowspan="2">Returns</th>
                                        <th rowspan="2">Sold Packs</th>
                                        <th rowspan="2">Peso Sale</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">1st</th>
                                        <th scope="col">2nd</th>
                                        <th scope="col">3rd</th>
                                        <th scope="col">4th</th>
                                        <th scope="col">5th</th>
                                        <th scope="col">6th</th>
                                        <th scope="col">1st</th>
                                        <th scope="col">2nd</th>
                                        <th scope="col">3rd</th>
                                        <th scope="col">4th</th>
                                        <th scope="col">5th</th>
                                        <th scope="col">6th</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Piso Token</td>
                                        <td>500</td>
                                        <td>500</td>
                                        <td>500</td>
                                        <td>500</td>
                                        <td>500</td>
                                        <td>500</td>
                                        <td>3,000</td>
                                        <td>[UserID]</td>
                                        <td>[UserID]</td>
                                        <td>[UserID]</td>
                                        <td>[UserID]</td>
                                        <td>[UserID]</td>
                                        <td>[UserID]</td>
                                        <td>22</td>
                                        <td>2,978</td>
                                        <td>13,500.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="17" style="text-align: right"><strong>Total:</strong></td>
                                        <td><strong>2,978.00</strong></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-primary">Save</button>
                        <button class="btn btn-warning">Cancel</button>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ticket_tab">
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Capacity(CBF)</th>
                                <th>Available Space(CBF)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>WH10001</td>
                                <td>Warehouse 1</td>
                                <td>1000</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <td>WH10002</td>
                                <td>Warehouse 2</td>
                                <td>800</td>
                                <td>100</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td>TOTAL:</td>
                                <td>1800</td>
                                <td>350</td>
                            </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function() {
        $('.nav-tabs').tab();
    });
</script>