<?php

/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 07:28
 * Description:
 */
//var_dump($berkasInfo)

function tgl_indo($tanggal)
{
        $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
function hari_ini($date)
{
        switch ($date) {
                case 'Sun':
                        $hari_ini = "Minggu";
                        break;

                case 'Mon':
                        $hari_ini = "Senin";
                        break;

                case 'Tue':
                        $hari_ini = "Selasa";
                        break;

                case 'Wed':
                        $hari_ini = "Rabu";
                        break;

                case 'Thu':
                        $hari_ini = "Kamis";
                        break;

                case 'Fri':
                        $hari_ini = "Jumat";
                        break;

                case 'Sat':
                        $hari_ini = "Sabtu";
                        break;

                default:
                        $hari_ini = "Tidak di ketahui";
                        break;
        }

        return $hari_ini;
}
?>
<html>

<head>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <meta name=Generator content="Microsoft Word 15 (filtered)">
        <style>
                <!--
                /* Font Definitions */
                @font-face {
                        font-family: "Cambria Math";
                        panose-1: 2 4 5 3 5 4 6 3 2 4;
                }

                /* Style Definitions */
                p.MsoNormal,
                li.MsoNormal,
                div.MsoNormal {
                        margin: 0in;
                        line-height: 115%;
                        font-size: 11.0pt;
                        font-family: "Arial", sans-serif;
                }

                .MsoChpDefault {
                        font-family: "Arial", sans-serif;
                }

                .MsoPapDefault {
                        line-height: 115%;
                }

                @page WordSection1 {
                        size: 595.45pt 841.7pt;
                        margin: 1.0in 1.0in 1.0in 1.0in;
                }

                div.WordSection1 {
                        page: WordSection1;
                }
                -->
        </style>

</head>

<body lang=EN-US style='word-wrap:break-word'>

        <div class=WordSection1>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><b><span style='font-size:14.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>LEMBAR PENGESAHAN</span></b></p>

                <p class=MsoNormal style='line-height:150%'><span style='font-size:11.0pt;
line-height:150%;font-family:"Times New Roman",serif;color:#222222'>Judul                           :
                                <?= $judulTa ?></span></p>

                <p class=MsoNormal style='line-height:150%'><span style='font-size:11.0pt;
line-height:150%;font-family:"Times New Roman",serif;color:#222222'>Nama                           :
                                <?= $mahasiswaInfo[0]->nama ?></span></p>

                <p class=MsoNormal style='line-height:150%'><span style='font-size:11.0pt;
line-height:150%;font-family:"Times New Roman",serif;color:#222222'>Program
                                Studi             : Teknologi Rekayasa Perangkat Lunak</span></p>

                <p class=MsoNormal style='line-height:150%'><span style='font-size:11.0pt;
line-height:150%;font-family:"Times New Roman",serif;color:#222222'>Pembimbing                :
                                <?= $dataDosbing[0]->gelar_depan ?> <?= $dataDosbing[0]->nama ?> <?= $dataDosbing[0]->gelar_belakang ?></span></p>

                <p class=MsoNormal style='line-height:150%'><span style='font-size:11.0pt;
line-height:150%;font-family:"Times New Roman",serif;color:#222222'>Waktu Ujian                :
                                <?= hari_ini(date('D'), strtotime($sidangInfo[0]->tanggal)) ?> <?= tgl_indo(date('Y-m-d'), strtotime($sidangInfo[0]->tanggal)) ?> <?= date('H:i', strtotime($sidangInfo[0]->waktu)) ?> sampai <?= date('H:i', strtotime($sidangInfo[0]->waktu_selesai)) ?> di <?= $sidangInfo[0]->ruang ?></span></p>

                <div class=MsoNormal align=center style='text-align:center;line-height:150%'>

                        <hr size=2 width="100%" align=center>

                </div>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>Telah dipertanggungjawabkan dan diuji oleh Tim Penguji serta
                                disetujui dan disahkan</span></p>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>Sebagai syarat kelengkapan studi jenjang Sarjana</span></p>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><a name="_fqj6yhniemwh"></a><span style='font-size:11.0pt;line-height:150%;
font-family:"Times New Roman",serif;color:#222222'>&nbsp;</span></p>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><a name="_gjdgxs"></a><span style='font-size:11.0pt;line-height:150%;font-family:
"Times New Roman",serif;color:#222222'>Yogyakarta, <?= tgl_indo(date('Y-m-d'), strtotime($sidangInfo[0]->tanggal)) ?></span></p>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><a name="_3bhb8x77k7io"></a><span style='font-size:11.0pt;line-height:150%;
font-family:"Times New Roman",serif;color:#222222'>&nbsp;</span></p>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>Tim Penguji</span></p>

                <table style="width: 100%;font-size:11.0pt;">
                        <tr>
                                <td style="text-align: center;">Ketua</td>
                                <td style="text-align: center;">Sekretaris</td>
                        </tr>
                        <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                        </tr>
                        <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                        </tr>
                        <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                        </tr>
                        <tr>
                                <td style="text-align: center;"><u><?= $ketuaInfo[0]->gelar_depan ?> <?= $ketuaInfo[0]->nama ?> <?= $ketuaInfo[0]->gelar_belakang ?></u></td>
                                <td style="text-align: center;"><u><?= $sekreInfo[0]->gelar_depan ?> <?= $sekreInfo[0]->nama ?> <?= $sekreInfo[0]->gelar_belakang ?></u></td>
                        </tr>
                        <tr>
                                <td style="text-align: center;">NIKA.<?= $ketuaInfo[0]->nid ?></td>
                                <td style="text-align: center;">NIKA.<?= $sekreInfo[0]->nid ?></td>
                        </tr>
                </table>
                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>Anggota</span></p>

                <p class=MsoNormal style='text-align:center;line-height:150%'><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>&nbsp;</span></p>
                <br>
                <br>
                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><u><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222;background:white'><?= $anggotaInfo[0]->gelar_depan ?> <?= $anggotaInfo[0]->nama ?> <?= $anggotaInfo[0]->gelar_belakang ?></span></u></p>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>NIKA.<?= $anggotaInfo[0]->nid ?></span></p>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>&nbsp;</span></p>

                <p class=MsoNormal align=center style='text-align:center;line-height:150%'><span style='font-size:11.0pt;line-height:150%;font-family:"Times New Roman",serif;
color:#222222'>Mengetahui,</span></p>

                <table style="width: 100%;font-size:11.0pt;">
                        <tr>
                                <td style="text-align: center;">Ketua Departemen</td>
                                <td style="text-align: center;">Ketua Program Studi Jurusan</td>
                        </tr>
                        <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                        </tr>
                        <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                        </tr>
                        <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                        </tr>
                        <tr>
                                <td style="text-align: center;"><u>Nur Rohman Rosyid, S.T., M.T., D.Eng</u></td>
                                <td style="text-align: center;"><u>Divi Galih Prasetyo Putri, S.Kom., M.Kom., Ph.D.</u></td>
                        </tr>
                        <tr>
                                <td style="text-align: center;">NIKA.111197510201206101</td>
                                <td style="text-align: center;">NIKA.111199209201605201</td>
                        </tr>
                </table>
        </div>

        <script>
                window.print();
        </script>
</body>

</html>