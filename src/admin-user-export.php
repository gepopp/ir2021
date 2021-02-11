<?php


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

add_action('wp_ajax_export-users', function () {


    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $spreadsheet->getActiveSheet()->getStyle('M:M')
        ->getNumberFormat()
        ->setFormatCode('#');

    $sheet->setCellValue('A1', 'id');
    $sheet->setCellValue('B1', 'Vorname');
    $sheet->setCellValue('C1', 'Nachname');
    $sheet->setCellValue('D1', 'E-Mail');
    $sheet->setCellValue('E1', 'Rolle');

    $sheet->getStyle('A1:K1')->getFont()->setSize(12)->setBold(true);

    $writer = new Xlsx($spreadsheet);

    if (!is_dir(get_stylesheet_directory() . '/excel')) {
        mkdir(get_stylesheet_directory() . '/excel');
    }

    $writer->save(get_stylesheet_directory() . '/excel/user-export.xlsx');


    $users = get_users(['fields' => ['ID', 'user_email'], 'role' => 'Subscriber', 'orderby' => 'user_registered', 'order' => 'DESC']);


    $runner = 2;
    foreach ($users as $user_id) {

        $meta = get_user_meta($user_id->ID);
        //echo print_r( $user_id);

        $sheet->setCellValue('A' . $runner, $user_id->ID);
        $sheet->setCellValue('B' . $runner, $meta['first_name'][0]);
        $sheet->setCellValue('C' . $runner, $meta['last_name'][0]);
        $sheet->setCellValue('D' . $runner, $user_id->user_email);
        $sheet->setCellValue('E' . $runner, get_userdata($user_id->ID)->roles[0]);


        $runner++;
    }

    foreach (range('A', 'J') as $columnID) {
        $sheet->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    unlink(get_stylesheet_directory() . '/excel/user-export.xlsx');

    $writer = new Xlsx($spreadsheet);

    $writer->save(get_stylesheet_directory() . '/excel/user-export.xlsx');

    wp_die(get_stylesheet_directory_uri() . '/excel/user-export.xlsx');
});