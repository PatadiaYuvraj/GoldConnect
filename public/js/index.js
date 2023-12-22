// JavaScript for adding/deleting items dynamically
$(document).ready(function () {
    // $("#date").val(new Date().toLocaleDateString());
    // $("#date").val();
    // var field = document.querySelector("#date");
    var field = $("#date")[0];
    var date = new Date();
    var isDateSupported = function () {
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

        $(".item-qty").each(function () {
            totalQty += parseFloat($(this).val()) || 0;
        });

        $(".item-gross-weight").each(function () {
            totalGrossWeight += parseFloat($(this).val()) || 0;
        });

        $(".item-ignored-weight").each(function () {
            totalIgnoredWeight += parseFloat($(this).val()) || 0;
        });

        $(".item-net-weight").each(function () {
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
    $("#addItemBtn").click(function () {
        addItemRow();
    });

    // Delete item row when the "Delete" button is clicked
    $(document).on("click", ".delete-item", function () {
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
    // Update net weight when quantity, gross weight, or ignored weight is changed
    $(document).on(
        "input",
        ".item-qty, .item-gross-weight, .item-ignored-weight, #gold_price_24k_1g",
        function () {
            // const row = $(this).closest("tr");
            // const qty = parseFloat(row.find(".item-qty").val()) || 0;
            // const grossWeight =
            //     parseFloat(row.find(".item-gross-weight").val()) || 0;
            // const ignoredWeight =
            //     parseFloat(row.find(".item-ignored-weight").val()) || 0;
            // const netWeight = grossWeight - ignoredWeight;
            // row.find(".item-net-weight").val(netWeight.toFixed(2));

            // // Calculate the product of qty, grossWeight, ignoredWeight, and netWeight
            // const product = qty * grossWeight * ignoredWeight * netWeight;
            // row.find(".item-product").val(product.toFixed(2));

            // updateTotalValues();
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

    // $("#validationCustom04").on("click", () => {
    //     const { value: branch_name } = Swal.fire({
    //         title: "Select Bank Branch",
    //         input: "select",
    //         inputOptions: {
    //             "Federal Bank": {
    //                 "Federal Bank(Limbda chowk)": "Limbda chowk",
    //                 "Federal Bank(Kalavad road)": "Kalavad road",
    //                 "Federal Bank(Bhupendra road)": "Bhupendra road",
    //                 "Federal Bank(Shapar)": "Shapar",
    //             },
    //             "Union Bank": {
    //                 "Union Bank(Bhakti Nagar)": "Bhakti Nagar",
    //                 "Union Bank(Nana mauva)": "Nana mauva",
    //             },
    //             "KVB Bank": {
    //                 "KVB Bank": "KVB Bank",
    //             },
    //         },
    //         inputPlaceholder: "Select a branch name",
    //         showCancelButton: true,
    //         inputValidator: (value) => {
    //             return new Promise((resolve) => {
    //                 if (value) {
    //                     console.log(value);
    //                     $("#validationCustom04").val(value);
    //                     resolve();
    //                 } else {
    //                     resolve("You need to select any one bank branch :)");
    //                 }
    //             });
    //         },
    //     });
    // });

    $("#submit_form").on("submit", function (e) {
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
        setTimeout(function () {
            $("#submit_btn").prop("disabled", false);
        }, 5000);
    });
    // $("#submit_btn").click((e) => {
    //     e.preventDefault();
    //     let form = $("form");
    //     console.log(form.serialize());
    //     $.ajax({
    //         type: "POST",
    //         url: "/form-submit",
    //         data: form.serialize(),
    //         success: function (data) {
    //             // Ajax call completed successfully
    //             console.log("success");
    //             console.log(data);
    //         },
    //         error: function (data) {
    //             // Some error in ajax call
    //             console.log("error");
    //             console.log(data);
    //         },
    //     });
    // });
});
