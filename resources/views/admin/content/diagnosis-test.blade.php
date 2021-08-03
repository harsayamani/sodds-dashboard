@extends('admin.master.master')
@section('tab_title', 'Diagnosis Test | SODDS Admin')
@section('is_active2', 'active')
@section('page_title', 'Diagnosis Test')
@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-ds-tab" data-toggle="pill" href="#pills-ds" role="tab" aria-controls="pills-ds" aria-selected="true">Dempster-Shafer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-cf-tab" data-toggle="pill" href="#pills-cf" role="tab" aria-controls="pills-cf" aria-selected="false">Certainty Factor</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            {{-- TAB1 --}}
            <div class="tab-pane fade show active" id="pills-ds" role="tabpanel" aria-labelledby="pills-ds-tab">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Diagnosis</div>
                                <p class="card-category">Form</p>
                            </div>
                            <div class="card-body">
                                <div class="card-sub">
                                    Choose the evidence suffered by the onion
                                </div>
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            {{-- <th scope="col">Code</th> --}}
                                            <th scope="col">Evidence</th>
                                            <th scope="col">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input select-all-checkbox" type="checkbox" data-select="checkbox" data-target=".task-select">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($evidences as $key => $evidence)
                                        <tr>
                                            {{-- <td>{{$evidence->code}}</td> --}}
                                            <td>{{$evidence->evidence}}</td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input task-select" type="checkbox" name="evidences[]" value="{{$evidence->code}}">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" onclick="diagnosis()">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Diagnosis</h4>
                                <p class="card-category">Result</p>
                            </div>
                            <div class="card-body">
                                <div id="diag_result"><center><h4>Nan</h4></center></div>
                            </div>
                        </div>
                        <div class="card" id="card_confidence" style="visibility: hidden">
                            <div class="card-header">
                                <h4 class="card-title">Confidence Level</h4>
                            </div>
                            <div class="card-body">
                                <div id="confidence_level"><center>......</center></div>
                            </div>
                            <div id="submit_confidence"></div>
                        </div>
                        <div class="card" id="card_result" style="visibility: hidden">
                            <div class="card-header">
                                <h4 class="card-title">Confidence Level</h4>
                                <p class="card-category">Result</p>
                            </div>
                            <div class="card-body">
                                <div id="confidence_result"><center>......</center></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB2 --}}
            <div class="tab-pane fade" id="pills-cf" role="tabpanel" aria-labelledby="pills-cf-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Diagnosis</div>
                                <p class="card-category">Form</p>
                            </div>
                            <div class="card-body">
                                <div class="card-sub">
                                    Choose the evidence suffered by the onion
                                </div>
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            {{-- <th scope="col">Code</th> --}}
                                            <th scope="col">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input select-all-checkbox" type="checkbox" data-select="checkbox" data-target=".task-select">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th scope="col">Evidence</th>
                                            <th scope="col" class="text-center">Confidence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($evidences as $key => $evidence)
                                        <tr>
                                            {{-- <td>{{$evidence->code}}</td> --}}
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input task-select" type="checkbox" name="evidences2[]" value="{{$evidence->code}}">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{$evidence->evidence}}</td>
                                            <td class="text-center">
                                                <div class="form-check">
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="evidence2{{$evidence->code}}" value="K1">
                                                        <span class="form-radio-sign">Sangat Yakin</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="evidence2{{$evidence->code}}" value="K2">
                                                        <span class="form-radio-sign">Yakin</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="evidence2{{$evidence->code}}" value="K3">
                                                        <span class="form-radio-sign">Cukup Yakin</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="evidence2{{$evidence->code}}" value="K4">
                                                        <span class="form-radio-sign">Kurang Yakin</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="evidence2{{$evidence->code}}" value="K5">
                                                        <span class="form-radio-sign">Tidak Tahu</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="evidence2{{$evidence->code}}" value="K6">
                                                        <span class="form-radio-sign">Tidak</span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" onclick="diagnosis2()">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Diagnosis</h4>
                                <p class="card-category">Result</p>
                            </div>
                            <div class="card-body">
                                <div id="diag_result2"><center><h4>Nan</h4></center></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Diagnosis</h4>
                                <p class="card-category">Disease Posiibility</p>
                            </div>
                            <div class="card-body">
                                <div id="disease_pos">
                                    <center><h4>Nan</h4></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script >
    // cardConfidence.style.visibility = "hidden"
    let evcodes = []
    let discode;
    let diseaseResult;
    let cardResult = document.getElementById('card_result');

    function diagnosis() {
        let evidences = document.getElementsByName('evidences[]');
        let diagResult = document.getElementById('diag_result');
        let submitConfidence = document.getElementById('submit_confidence');
        let cardConfidence = document.getElementById('card_confidence');
        let confidenceLevel = $('#confidence_level');
        let len = evidences.length
        let arrEvidence = [];
        let a = 0;

        window.scrollTo(0,0);
        let loader = `<center><div class="loader"></div></center>`;
        diagResult.innerHTML = loader;
        cardResult.style.visibility = "hidden";
        confidenceLevel.html(loader);

        for (let i=0; i<len; i++) {
            if(evidences[i].checked){
                arrEvidence[a] = evidences[i].value;
                a++
            }
        }

        $.ajax({
            url: "/admin/diagnosis/process",
            type:"POST",
            data : {
                "_token": "{{ csrf_token() }}",
                "evidences": arrEvidence
            },
            dataType: "json",
            success: function(res){
                let html = `
                    <br>
                    <center><h4>${res.disease}</h4></center>
                    <br>
                    <div class="dropdown-divider"></div>
                    <table>
                        <tr>
                            <td>Disease Code</td>
                            <td> : </td>
                            <td><b>${res.code}<b></td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td> : </td>
                            <td><b>${res.weight}</b></td>
                        </tr>
                    </table>
                `
                diagResult.innerHTML = html;

                let rulescf = res.rulescf;
                let lenRulescf = rulescf.length;

                cardConfidence.style.visibility = "visible"
                confidenceLevel.empty();

                let result = `
                    <p>Tanamaan bawang merah anda terindikasi penyakit <b>${res.disease}</b>. Berikut ini merupakan gejala-gejala yang sering ditemui pada penyakit <b>${res.disease}</b>:</p>
                `;

                confidenceLevel.append(result);
                discode = res.code;
                diseaseResult = res.disease;

                let x = 0;

                for(let i=0; i<lenRulescf; i++) {
                    $.ajax({
                        url: "/admin/evidence/get-evidence",
                        type:"POST",
                        data : {
                            "_token": "{{ csrf_token() }}",
                            "evcode": rulescf[i].evcode
                        },
                        dataType: "json",
                        success: function(res) {
                            x++;

                            let confidence = `
                            <div class="form-check">
                                <label>${x}. Apakah tanaman bawang merah anda mengalami gejala <b>${res.data.evidence.toLowerCase()}</b>?</label><br/>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="evidence${rulescf[i].evcode}" value="K1">
                                    <span class="form-radio-sign">Sangat Yakin</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="evidence${rulescf[i].evcode}" value="K2">
                                    <span class="form-radio-sign">Yakin</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="evidence${rulescf[i].evcode}" value="K3">
                                    <span class="form-radio-sign">Cukup Yakin</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="evidence${rulescf[i].evcode}" value="K4">
                                    <span class="form-radio-sign">Kurang Yakin</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="evidence${rulescf[i].evcode}" value="K5">
                                    <span class="form-radio-sign">Tidak Tahu</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="evidence${rulescf[i].evcode}" value="K6">
                                    <span class="form-radio-sign">Tidak</span>
                                </label>
                            </div>
                            `;

                            confidenceLevel.append(confidence);
                            evcodes[i] = rulescf[i].evcode;
                        }
                    });
                }

                let submit = `
                    <div class="card-action">
                        <button class="btn btn-success" onclick="diagnosisCF()">Submit</button>
                    </div>
                `
                submitConfidence.innerHTML = submit;
            }
        });
    }

    function diagnosisCF() {
        let usercfs = [];
        let loader = `<center><div class="loader"></div></center>`;
        let confidenceResult = document.getElementById('confidence_result');

        cardResult.style.visibility = "visible";
        confidenceResult.innerHTML = loader;

        for (let i=0; i<evcodes.length; i++) {
            let confidenceChecked = document.querySelector('input[name=evidence'+evcodes[i]+']:checked').value;

            let usercf = {
                'evcode': evcodes[i],
                'cfvalcode':confidenceChecked
            }

            usercfs[i] = usercf;
        }

        $.ajax({
            url: "/admin/diagnosiscf/process",
            type:"POST",
            data : {
                "_token": "{{ csrf_token() }}",
                "disease": discode,
                "usercf": usercfs
            },
            dataType: "json",
            success: function(res){
                let confidence = res.data;

                let html = `
                    <center>
                    <h4 style="margin: 30px">${confidence.cf_persen}</h4>
                    <p>Berdasarkan tingkat keyakinan yang diberikan pakar ditambah kondisi di lapangan yang diperoleh oleh pengguna terhadap gejala dari penyakit <b>${diseaseResult}</b></p>
                    </center>
                `;

                confidenceResult.innerHTML = html;
            }
        });
    }
</script>

<script>
    function diagnosis2() {
        let evidences = document.getElementsByName('evidences2[]');
        let diagResult = document.getElementById('diag_result2');
        let dispos = document.getElementById('disease_pos');
        let arrEvidences = [];
        let usercfs = [];
        let a = 0;
        let loader = `<center><div class="loader"></div></center>`;
        diagResult.innerHTML = loader;
        dispos.innerHTML = loader;

        for (let i=0; i<evidences.length; i++) {
            if(evidences[i].checked){
                arrEvidences[a] = evidences[i].value;
                a++
            }
        }

        for(let j=0; j<arrEvidences.length; j++) {
            let confidenceChecked = document.querySelector('input[name=evidence2'+arrEvidences[j]+']:checked').value;
            let usercf = {
                'evcode': arrEvidences[j],
                'cfvalcode':confidenceChecked
            }

            usercfs[j] = usercf;
        }

        $.ajax({
            url: "/admin/diagnosis2/process",
            type:"POST",
            data : {
                "_token": "{{ csrf_token() }}",
                "evidences": usercfs
            },
            dataType: "json",
            success: function(res){
                let html = `
                    <br>
                    <center><h4>${res.disease}</h4></center>
                    <br>
                    <div class="dropdown-divider"></div>
                    <table>
                        <tr>
                            <td>Disease Code</td>
                            <td> : </td>
                            <td><b>${res.disease_detail.code}<b></td>
                        </tr>
                        <tr>
                            <td>CF Persent</td>
                            <td> : </td>
                            <td><b>${res.cf_persen}</b></td>
                        </tr>
                    </table>
                `
                diagResult.innerHTML = html;

                let hipo = res.hipo;
                let htmldispostable = `
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Disease</th>
                                <th scope="col">Percentage</th>
                            </tr>
                        </thead>
                        <tbody id="dispos_table">

                        </tbody>
                    </table>
                `
                dispos.innerHTML = htmldispostable;
                let disposTable = $('#dispos_table');

                for(let k=0; k<hipo.length; k++){
                    $.ajax({
                        url: "/admin/disease/get-disease",
                        type:"POST",
                        data : {
                            "_token": "{{ csrf_token() }}",
                            "discode": hipo[k].discode
                        },
                        dataType: "json",
                        success: function(resp){
                            console.log(resp);
                            let html = `
                                <tr>
                                    <td>${hipo[k].discode}</td>
                                    <td>${resp.data.disease}</td>
                                    <td>${hipo[k].cf_persen}</td>
                                </tr>
                            `

                            disposTable.append(html);
                        }
                    });
                }
            }
        });
    }
</script>
@endpush
@endsection
