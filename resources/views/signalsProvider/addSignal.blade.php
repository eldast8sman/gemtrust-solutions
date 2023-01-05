
@section('pageTitle')
    Gemtrust Dashboard || Add, Send signals
@endsection

@extends('signalsProvider.layouts.default')

@section('content')

                <!-- Add Article -->

                <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4">Add Signals</h3>

                            <form>    
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="currencyPair"
                                                placeholder="Currency Pair">
                                            <label for="currencyPair">Currency Pair</label>
                                        </div>
                                
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="orderType" 
                                                placeholder="Order Type">
                                            <label for="orderType">Order Type</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="lotSize" 
                                                placeholder="Lot Size">
                                            <label for="lotSize">Lot Size</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="entryPrice" 
                                                placeholder="Entry Price">
                                            <label for="entryPrice">Entry Price</label>
                                        </div>
                                    </div>
                                </div>
                                            
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="take_profit_1"
                                                placeholder="Take profit 1">
                                            <label for="take_profit_1">Take profit 1</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="take_profit_2" 
                                                placeholder="Take profit 2">
                                            <label for="take_profit_2">Take profit 2</label>
                                        </div>
                                    </div>
                                </div>
                                            
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="take_profit_3"
                                                placeholder="Take profit 3">
                                            <label for="take_profit_3">Take profit 3</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="stopLose" 
                                                placeholder="Stop Lose">
                                            <label for="stopLose">Stop Lose</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="remark" 
                                        placeholder="Description" style="height: 150px;"></textarea>
                                    <label for="remark">Description</label>
                                </div>

                                <button type="button" class="btn btn-primary py-3 w-100 mb-4" id="btnFunc" onclick="sendSignal()">Send Signal</button>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- End of Add Package -->

@endsection