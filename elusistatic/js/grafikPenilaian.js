$(document).ready(function () {
    tampil_grafik_rata2();

    id_periode = $('#select_periode').val();
    tampil_diagram_nilai_sidang(id_periode);

    $('#select_periode').change(function () {
        id_periode = $('#select_periode').val();
        tampil_diagram_nilai_sidang(id_periode);
    });

    var pie
    var line


    function tampil_diagram_nilai_sidang(id_periode) {
        console.log(id_periode);
        if (id_periode != 0) {
            $.ajax({
                type: "GET",
                url: baseURL + "akademik/dashboard/getPenilaianSidang",
                data: {
                    id_periode: id_periode
                },
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    array_pie_series = [];
                    $.each(res, function (prop, value) {
                        obj = {
                            value: value,
                            name: prop
                        }
                        array_pie_series.push(obj);
                    });
                    console.log(array_pie_series);
                    var echartPie = echarts.init(document.getElementById('diagram_lingkaran'));
                    option = {
                        color: ['#ff7f50', '#87cefa', '#da70d6', '#32cd32', '#6495ed',
                            '#ff69b4', '#ba55d3', '#cd5c5c', '#ffa500', '#40e0d0',
                            '#1e90ff', '#ff6347', '#7b68ee', '#00fa9a', '#ffd700',
                            '#6699FF', '#ff6666', '#3cb371', '#b8860b', '#30e0e0'
                        ],
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: ['A', 'A-', 'A/B', 'B+', 'B', 'B-', 'B/C', 'C+', 'C', 'C-', 'Tidak Lulus']
                        },
                        toolbox: {
                            show: true,
                            showTitle: false,
                            feature: {
                                saveAsImage: {
                                    show: true
                                }
                            }
                        },
                        calculable: true,
                        series: [{
                            type: 'pie',
                            radius: '55%',
                            center: ['50%', '60%'],
                            data: array_pie_series
                        }]
                    };
                    echartPie.setOption(option);
                    pie = echartPie;

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('jqXHR:');
                    console.log(jqXHR);
                    console.log('textStatus:');
                    console.log(textStatus);
                    console.log('errorThrown:');
                    console.log(errorThrown);
                }
            });
        } else {
            var echartPie = echarts.init(document.getElementById('diagram_lingkaran'));
            option = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: ['No Data']
                },
                toolbox: {
                    showTitle: false,
                    show: true,
                    feature: {
                        saveAsImage: {
                            show: true
                        }
                    }
                },
                calculable: true,
                series: [{
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '60%'],
                    data: [{value:0, name:'No Data'}]
                }]
            };
            echartPie.setOption(option);
            pie = echartPie;
        }
        return false;
    }

    function tampil_grafik_rata2() {
        array = dataNilai;
        if (array != 0) {
            array_nama_periode = [];
            array_nama_komponen = [];
            array_nilai = {};
            array_series = [];

            // console.log(array);
            $.each(array[0].data_nilai, function (prop, value) {
                array_nama_komponen.push(prop);
                array_nilai[prop] = [];
            });
            // console.log(array_nilai);
            // console.log(array_nama_komponen);

            $.each(array, function (index, obj) {
                array_nama_periode.push(obj.nama_periode);
                $.each(obj.data_nilai, function (prop, value) {
                    array_nilai[prop].push(value);
                });
            });

            for (let prop in array_nilai) {
                array_series.push({
                    name: prop,
                    type: 'line',
                    smooth: true,
                    data: array_nilai[prop]
                });
            }
            //console.log(array_series);
        } else {
            array_nama_periode = ['No data'];
            array_nama_komponen = ['No data'];
            array_series = {
                name: 'No Data',
                type: 'line',
                smooth: true,
                data: [0]
            };
        }

        var theme = {
            title: {
                itemGap: 8,
                textStyle: {
                    fontWeight: 'normal',
                    color: '#408829'
                }
            },

            dataRange: {
                color: ['#1f610a', '#97b58d']
            },

            toolbox: {
                color: ['#408829', '#408829', '#408829', '#408829']
            },

            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.5)',
                axisPointer: {
                    type: 'line',
                    lineStyle: {
                        color: '#408829',
                        type: 'dashed'
                    },
                    crossStyle: {
                        color: '#408829'
                    },
                    shadowStyle: {
                        color: 'rgba(200,200,200,0.3)'
                    }
                }
            },
        }
        var echartLine = echarts.init(document.getElementById('diagram'), theme);

        echartLine.setOption({
            color: ['#ff7f50', '#87cefa', '#da70d6', '#32cd32', '#6495ed',
                '#ff69b4', '#ba55d3', '#cd5c5c', '#ffa500', '#40e0d0',
                '#1e90ff', '#ff6347', '#7b68ee', '#00fa9a', '#ffd700',
                '#6699FF', '#ff6666', '#3cb371', '#b8860b', '#30e0e0'
            ],
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: array_nama_komponen
            },
            toolbox: {
                show: true,
                orient: 'vertical',
                y: 'center',
                showTitle: false,
                feature: {
                    magicType: {
                        show: true,
                        title: {
                            line: 'Line',
                            bar: 'Bar'
                        },
                        type: ['line', 'bar']
                    },
                    restore: {
                        show: true,
                        title: "Restore"
                    },
                    saveAsImage: {
                        show: true,
                        title: "Save Image"
                    }
                }
            },
            calculable: true,
            xAxis: [{
                type: 'category',
                boundaryGap: false,
                data: array_nama_periode
            }],
            yAxis: [{
                type: 'value',
                scale: true,
                max: 4.0,
                splitNumber: 8
            }],
            series: array_series
        });
        line = echartLine;
        
        return false;
    }
    window.onresize = function () {
        line.resize();
        pie.resize();
    };
});