<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gold Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body class="">
    {{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" style="font-size: 1.5rem; font-family: algerian">Jiya Design Jewellery</a>
        </div>
    </nav> --}}
    <div class="container my-3 card">
        @foreach ($data as $account)
            <div class="card my-3">
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <span class="form-control">
                                {{ $account['name'] }}
                            </span>
                        </div>
                        <div class="col">
                            <label for="phone" class="form-label">Phone Number</label>
                            <span class="form-control">
                                {{ $account['phone'] }}
                            </span>
                        </div>
                        <div class="col" id="select_branch_name">
                            <label for="validationCustom04" class="form-label">Branch name</label>
                            <span class="form-control">
                                {{ $account['branch_name'] }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="date" class="form-label">Date</label>
                            <span class="form-control">
                                {{ $account['date'] }}
                            </span>
                        </div>

                        <div class="col">
                            <label for="rate" class="form-label">Gold Price in (1g of 24K)</label>
                            <span class="form-control">
                                {{ $account['gold_price_24k_1g'] }}
                            </span>
                        </div>
                        <div class="col">
                            <label for="phone" class="form-label">Total Rate</label>
                            <span class="form-control">
                                {{ $account['total_rate'] }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="phone" class="form-label">Total Amount(24k)</label>
                            <span class="form-control">
                                {{ $account['total_amount_24k'] }}
                            </span>
                        </div>
                        <div class="col">
                            <label for="phone" class="form-label">Total Amount(22k)</label>
                            <span class="form-control">
                                {{ $account['total_amount_22k'] }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <table class="text-center table table-responsive table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="col-2">Items</th>
                                <th scope="col" class="col-2">Qty</th>
                                <th scope="col" class="col-2">Gross Weight</th>
                                <th scope="col" class="col-2">Ignore Weight</th>
                                <th scope="col" class="col-2">Net Weight</th>
                            </tr>
                        </thead>
                        {{-- @for ($i = 0; $i < count($data['item_name']); $i++) --}}
                        @foreach ($account->items as $item)
                            <tr>
                                <td>
                                    <span class="form-control">
                                        {{ $item['item_name'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="form-control">
                                        {{ $item['item_qty'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="form-control">
                                        {{ $item['item_gross_weight'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="form-control">
                                        {{ $item['item_ignored_weight'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="form-control">
                                        {{ $item['item_net_weight'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                <span class="form-control">
                                    {{ 'Total' }}
                                </span>
                            </td>
                            <td>
                                <span class="form-control">
                                    {{ $account['total_qty'] }}
                                </span>
                            </td>
                            <td>
                                <span class="form-control">
                                    {{ $account['total_gross_weight'] }}
                                </span>
                            </td>
                            <td>
                                <span class="form-control">
                                    {{ $account['total_ignored_weight'] }}
                                </span>
                            </td>
                            <td>
                                <span class="form-control">
                                    {{ $account['total_net_weight'] }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
