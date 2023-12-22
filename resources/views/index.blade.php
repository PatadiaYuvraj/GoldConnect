<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/x-icon" href={{ asset('favicon.ico') }}>
    <title>Gold Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        body.swal2-shown>[aria-hidden="true"] {
            transition: 0.01s filter;
            filter: blur(10px);
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-size: 1.5rem; font-family: algerian">Jiya Design Jewellery</a>
            </div>
        </nav>
        <div class="container-fluid mt-3">
            <div class="card">
                <div class="card-body pb-0">
                    <form action="{{ route('form.submit') }}" id="submit_form" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-6">
                                <label for="validationCustom04" class="form-label">Branch name</label>
                                <select class="form-select" id="validationCustom04" required name='branch_name'>
                                    <option disabled selected>Not Selected</option>
                                    <optgroup label="Federal Bank">
                                        <option>Limbda chowk</option>
                                        <option>Kalavad road</option>
                                        <option>Bhupendra road</option>
                                        <option>Shapar</option>
                                    </optgroup>
                                    <optgroup label="Union Bank">
                                        <option>Bhakti Nagar</option>
                                        <option>Nana mauva</option>
                                    </optgroup>
                                    <optgroup label="KVB Bank">
                                        <option>KVB Bank</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="date" class="form-label">Date</label>

                                <input type="date" class="form-control" id="date" name="date" required>

                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone"
                                    placeholder="Enter phone number" name="phone" value="{{ old('phone') }}"
                                    required>
                            </div>
                            <div class="col">
                                <label for="gold_price_24k_1g" class="form-label">Gold Price in (1g of 24K)</label>
                                <input type="text" class="form-control" id="gold_price_24k_1g"
                                    placeholder="Enter gold price" name="gold_price_24k_1g"
                                    value="{{ old('gold_price_24k_1g') }}" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="phone" class="form-label">Total Amount(24k)</label>
                                <input type="text" class="form-control" name="total_amount_24k" id="total_amount_24k"
                                    value="00.00" required readonly>
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">Total Amount(22k)</label>
                                <input type="text" class="form-control" name="total_amount_22k" id="total_amount_22k"
                                    value="00.00" required readonly>
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">Total Rate</label>
                                <select class="form-control" name="total_rate" id="total_rate" placeholder="Item Name"
                                    required>
                                    <option value="80" selected>80</option>
                                    <option value="82">82</option>
                                    <option value="84">84</option>
                                    <option value="88">88</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div>
                            <div class="">
                                <table class="table table-responsive table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-2">Items</th>
                                            <th scope="col" class="col-2">Qty</th>
                                            <th scope="col" class="col-2">Gross Weight</th>
                                            <th scope="col" class="col-2">Ignore Weight</th>
                                            <th scope="col" class="col-2">Net Weight</th>
                                            <th scope="col" class="col-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemTableBody">
                                        <!-- Existing items in the table will be appended here -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td><input type="number" class="form-control" name="total_qty"
                                                    id="total_qty" value=0 readonly required></td>
                                            <td><input type="number" class="form-control" name="total_gross_weight"
                                                    id="total_gross_weight" value=0 readonly required></td>
                                            <td><input type="number" class="form-control"
                                                    name="total_ignored_weight" id="total_ignored_weight" value=0
                                                    readonly required></td>
                                            <td><input type="number" class="form-control" name="total_net_weight"
                                                    id="total_net_weight" value=0 readonly required></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="10" class="text-center gap-2">
                                                <button class="btn btn-primary col-2" id="submit_btn">Print as
                                                    PDF</button>
                                                <button type="button" class="btn btn-success col-2"
                                                    id="addItemBtn">Add
                                                    Item</button>
                                                <button class="btn btn-danger col-2" type="reset">Reset</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    {{-- <script src="{{ asset('js/jquery.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="{{ asset('js/sweetalert2.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    {{-- <script src="{{ asset('js/jquery.validate.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/additional-methods.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script src="{{ asset('js/toastr.min.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{ asset('js/bootstrap.bundle.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    {{-- <script src="{{ asset('js/index.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/form-validation.js') }}"></script> --}}
    @if ($errors->any())
            <script type="text/javascript">
                toastr.info("All Field are required")
            </script>
    @endif
    <script>
        // $(document).ready(function() {
        //     $("#submit_form").validate({
        //         rules: {
        //             name: {
        //                 required: true,
        //             },
        //             item_name[]: {
        //                 required: true,
        //             },
        //         },
        //     });
        // });
    </script>


    <script>
        // index.js 
        // JavaScript for adding/deleting items dynamically

        $(document).ready(function() {
            // $("#date").val(new Date().toLocaleDateString());
            // $("#date").val();
            // var field = document.querySelector("#date");
            var field = $("#date")[0];
            var date = new Date();
            var isDateSupported = function() {
                var input = document.createElement("input");
                input.setAttribute("type", "date");
                input.setAttribute("value", "x");
                return input.value !== "x";
            };
            if (isDateSupported()) {
                // Remove attributes
                field.removeAttribute("pattern");
                field.removeAttribute("placeholder");

                // Remove the helper text
                var helperText = document.querySelector('[for="today"] .description');
                if (helperText) {
                    helperText.parentNode.removeChild(helperText);
                }
            }

            // Set the value
            field.value =
                date.getFullYear().toString() +
                "-" +
                (date.getMonth() + 1).toString().padStart(2, 0) +
                "-" +
                date.getDate().toString().padStart(2, 0);

            let itemCount = 0;

            // Function to add a new row for an item
            function addItemRow() {
                itemCount++;
                // <input type="text" class="form-control" name="item_name[]" placeholder="Item Name" required>
                const newRow = `
                <tr id="itemRow_${itemCount}">
                    <td>
                    <input type="hidden" name='item_id[]' value="${itemCount}" />
                        <select class="form-control" name="item_name[]" placeholder="Item Name" required>
                            <option disabled selected>Not Selected</option>
                            <option value="Earrings">Earrings</option>
                            <option value="Ring">Ring</option>
                            <option value="Chain">Chain</option>
                            <option value="Necklace">Necklace</option>
                            <option value="Bangles">Bangles</option>
                            <option value="Pendant">Pendant</option>
                            <option value="Bracelet">Bracelet</option>
                            <option value="Mangalsutra">Mangalsutra</option>
                            <option value="Earring Chain">Earring Chain</option>
                            <option value="Mala">Mala</option>
                            <option value="Pocha">Pocha</option>
                            <option value="Bajubandh">Bajubandh</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control item-qty" name="item_qty[]" min="1" value="1" required>
                    </td>
                    <td>
                        <input type="number" class="form-control item-gross-weight" name="item_gross_weight[]" min="0" value="0" required>
                    </td>
                    <td>
                        <input type="number" class="form-control item-ignored-weight" name="item_ignored_weight[]" min="0" value="0" required>
                    </td>
                    <td>
                        <input type="number" class="form-control item-net-weight" name="item_net_weight[]" min="0" value="0" readonly required>
                    </td>
                    <td class=" text-center">
                        <button type="button" class="btn btn-danger delete-item" data-row="${itemCount}">Delete</button>
                    </td>
                </tr>
                `;

                $("#itemTableBody").append(newRow);
            }

            // Function to update the total values
            function updateTotalValues() {
                let totalQty = 0;
                let totalGrossWeight = 0;
                let totalIgnoredWeight = 0;
                let totalNetWeight = 0;

                $(".item-qty").each(function() {
                    totalQty += parseFloat($(this).val()) || 0;
                });

                $(".item-gross-weight").each(function() {
                    totalGrossWeight += parseFloat($(this).val()) || 0;
                });

                $(".item-ignored-weight").each(function() {
                    totalIgnoredWeight += parseFloat($(this).val()) || 0;
                });

                $(".item-net-weight").each(function() {
                    totalNetWeight += parseFloat($(this).val()) || 0;
                });

                $("#total_qty").val(totalQty.toFixed(2));
                $("#total_gross_weight").val(totalGrossWeight.toFixed(2));
                $("#total_ignored_weight").val(totalIgnoredWeight.toFixed(2));
                $("#total_net_weight").val(totalNetWeight.toFixed(2));
                changeTotalAmount();
            }
            // $("#total_amount");

            const changeTotalAmount = () => {
                let totalNetWeight = $("#total_net_weight").val();
                let total_amount_22k = 0;
                let total_amount_24k = 0;
                let total_rate = $("#total_rate").val();
                let gold_price_24k_1g = $("#gold_price_24k_1g").val();
                let multiplyable_rate = (totalNetWeight * total_rate) / 91.6;
                multiplyable_rate = multiplyable_rate.toFixed(2);
                total_amount_22k = gold_price_24k_1g * 0.916 * multiplyable_rate;
                total_amount_24k = gold_price_24k_1g * multiplyable_rate;

                $("#total_amount_22k").val(total_amount_22k.toFixed(2));
                $("#total_amount_24k").val(total_amount_24k.toFixed(2));
            };

            // Add item row when the "Add Item" button is clicked
            $("#addItemBtn").click(function() {
                addItemRow();
            });

            // Delete item row when the "Delete" button is clicked
            $(document).on("click", ".delete-item", function() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        itemCount--;
                        const rowId = $(this).data("row");
                        $("#itemRow_" + rowId).remove();
                        updateTotalValues();
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                    }
                });
            });
            $("#total_rate").on("change", () => {
                updateTotalValues();
            });
            $(document).on(
                "input",
                ".item-qty, .item-gross-weight, .item-ignored-weight, #gold_price_24k_1g",
                function() {
                    const row = $(this).closest("tr");
                    const qty = parseFloat(row.find(".item-qty").val()) || 1;
                    const grossWeight =
                        parseFloat(row.find(".item-gross-weight").val() * qty) || 0;

                    const ignoredWeight =
                        parseFloat(row.find(".item-ignored-weight").val() * qty) || 0;
                    const netWeight = grossWeight - ignoredWeight;
                    row.find(".item-net-weight").val(netWeight.toFixed(2));

                    updateTotalValues();
                }
            );

            $("#submit_form").on("submit", function(e) {
                e.preventDefault();
                if (itemCount > 0) {
                    if ($("#validationCustom04").val() !== ("", " ", null)) {
                        this.submit();
                    }
                } else {
                    Swal.fire({
                        title: "Please Add Atleast One Item",
                        text: "You can add item by pressing Add Item Button",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Add Item",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            addItemRow();
                            Swal.fire("Item Added", "Add item details", "success");
                        }
                    });
                }
            });
            $("#submit_btn").click(() => {
                $("#submit_form").submit();
                $("#submit_btn").prop("disabled", true);
                setTimeout(function() {
                    $("#submit_btn").prop("disabled", false);
                }, 5000);
            });
        });
    </script>
</body>

</html>
