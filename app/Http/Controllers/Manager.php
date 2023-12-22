<?php

namespace App\Http\Controllers;

// use App\Models\Account;
// use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use Exception as LaravelException;

class Manager extends Controller
{

    // public function insertData($data): void
    // {
    //     $account = new Account;
    //     $account->name = $data['name'];
    //     $account->branch_name = $data['branch_name'];
    //     $account->date = $data['date'];
    //     $account->phone = $data['phone'];
    //     $account->gold_price_24k_1g = $data['gold_price_24k_1g'];
    //     $account->total_rate = $data['total_rate'];
    //     $account->total_qty = $data['total_qty'];
    //     $account->total_gross_weight = $data['total_gross_weight'];
    //     $account->total_ignored_weight = $data['total_ignored_weight'];
    //     $account->total_net_weight = $data['total_net_weight'];
    //     $account->total_amount_22k = $data['total_amount_22k'];
    //     $account->total_amount_24k = $data['total_amount_24k'];
    //     $account->pdf_file_name = $data['pdf_file_name'];
    //     $account->save();
    //     for ($i = 0; $i < count($data['item_id']); $i++) {
    //         $item = new Item;
    //         $item->account_id = $account->id;
    //         $item->item_name = $data['item_name'][$i];
    //         $item->item_qty = $data['item_qty'][$i];
    //         $item->item_gross_weight = $data['item_gross_weight'][$i];
    //         $item->item_ignored_weight = $data['item_ignored_weight'][$i];
    //         $item->item_net_weight = $data['item_net_weight'][$i];
    //         $item->save();
    //     }
    // }

    // public function testMail()
    // {
    //     die("die(Not Working)");
    //     $mail = new PHPMailer(true);     // Passing `true` enables exceptions
    //     try {
    //         $mail->SMTPDebug = 0;
    //         $mail->isSMTP();
    //         $mail->Host = env("MAIL_HOST");
    //         $mail->SMTPAuth = true;
    //         $mail->Username = env("MAIL_USERNAME");
    //         $mail->Password = env("MAIL_PASSWORD");
    //         $mail->SMTPSecure = env("MAIL_ENCRYPTION");
    //         $mail->Port = env("MAIL_PORT");

    //         $mail->setFrom('patadia.yuvraj.06@gmail.com', env("MAIL_FROM_NAME")); //from
    //         $mail->addAddress("yamunesh.patadia.06@gmail.com"); //to
    //         // $mail->addCC("patadia.yuvraj.06@gmail.com");  // cc
    //         // $mail->addBCC("patadia.yuvraj.06@gmail.com");  // bcc

    //         $mail->addReplyTo('patadia.yuvraj.06@gmail.com', 'SenderReplyName');

    //         // if (isset($_FILES['emailAttachments'])) {
    //         //     for ($i = 0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
    //         //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
    //         //     }
    //         // }


    //         $mail->isHTML(true);

    //         $mail->Subject = "Testing Mail";
    //         $mail->Body    = view('mail');

    //         // $mail->AltBody = plain text version of email body;

    //         if (!$mail->send()) {
    //             return "error";
    //             // return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
    //         } else {
    //             return "sent";
    //             // return back()->with("success", "Email has been sent.");
    //         }
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
    public function index()
    {
        // try {
        //     DB::connection()->getPDO();
        //     echo "<link href='" . asset('css/toastr.min.css') . "' rel='stylesheet'>
        //     <script src='" . asset('js/toastr.min.js') . "'></script>
        //     <script>toastr.info(" . "'Hello'" . ")</script>
        //     ";
        return view("index");
        // echo DB::connection()->getDatabaseName();
        // } catch (LaravelException $e) {
        //     echo "<link href=" . asset('css/toastr.min.css') . " rel='stylesheet'>
        //     <script src=" . asset('js/toastr.min.js') . "></script>
        //     <script>toast.info('Couldn't connected to Database;')</script>
        //     ";
        // }
        // $accounts = Account::with('items')->get();
        // return view("mail");
    }

    public function formSubmit(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required',
            'name' => 'required',
            'branch_name' => 'required',
            'date' => 'required',
            'phone' => 'required',
            'gold_price_24k_1g' => 'required',
        ]);
        $data = $request->all();
        $data['pdf_file_name'] = "GoldManager_" . implode("_", explode(" ", $data['name'])) . "_" . time() . ".pdf";
        // dd($data);
        // self::insertData($data);
        // $account = new Account;
        // $account->name = $data['name'];
        // $account->branch_name = $data['branch_name'];
        // $account->date = $data['date'];
        // $account->phone = $data['phone'];
        // $account->gold_price_24k_1g = $data['gold_price_24k_1g'];
        // $account->total_qty = $data['total_qty'];
        // $account->total_gross_weight = $data['total_gross_weight'];
        // $account->total_ignored_weight = $data['total_ignored_weight'];
        // $account->total_net_weight = $data['total_net_weight'];
        // $account->total_amount_22k = $data['total_amount_22k'];
        // $account->total_amount_24k = $data['total_amount_24k'];
        // $account->pdf_file_name = $pdf_file_name;
        // $account->save();
        // for ($i = 0; $i < count($data['item_id']); $i++) {
        //     $item = new Item;
        //     $item->account_id = $account->id;
        //     $item->item_name = $data['item_name'][$i];
        //     $item->item_qty = $data['item_qty'][$i];
        //     $item->item_gross_weight = $data['item_gross_weight'][$i];
        //     $item->item_ignored_weight = $data['item_ignored_weight'][$i];
        //     $item->item_net_weight = $data['item_net_weight'][$i];
        //     $item->save();
        // }
        header("refresh:10;url=/");
        $pdf = Pdf::loadView('pdf.invoice', compact('data'))->save($data['pdf_file_name']);
        return $pdf->download($data['pdf_file_name']);
        // return $pdf->download($data['pdf_file_name']);
    }
    // public function getAccounts()
    // {
    //     $data = Account::with('items')->get();
    //     return view("getAccounts", compact("data"));
    // }
}
