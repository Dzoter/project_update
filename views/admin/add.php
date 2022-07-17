<?php

?>
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Add document </h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Forms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Validations</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->

    <div class="row">
        <!-- ============================================================== -->
        <!-- validation form -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Document Form</h5>
                <div class="card-body">
                    <form action="/admin/add" method="post">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="mb-3">Property Address</label>
                                <input type="text" name="property_number" class="form-control" placeholder="PROPERTY NUMBER" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <input type="text" class="form-control" name="street" placeholder="STREET" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">
                                <input type="text" class="form-control" name="town" placeholder="TOWN" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">
                                <input type="text" class="form-control" name="post_code" placeholder="POST CODE" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">
                                <input type="text" class="form-control" name="post_code_first_part" placeholder="POST CODE FIRST PART" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="mb-3">Client</label>
                                <input type="text" class="form-control" name="client" placeholder="CLIENT" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="mb-3">Purpose of Valuation</label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" checked name="purpose_of_valuation" class="custom-control-input" value="loan_security"><span class="custom-control-label">Loan Security</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="purpose_of_valuation" class="custom-control-input" value="internal"><span class="custom-control-label">Internal</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="purpose_of_valuation" class="custom-control-input" value="other"><span class="custom-control-label">Other</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="mb-3">Borrower</label>
                                <input type="text" class="form-control mb-5" name="borrower" placeholder="borrower" value="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="mb-3">Limited Liability</label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" checked name="limited_liability" value="yes" class="custom-control-input"><span class="custom-control-label">Yes</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="limited_liability" value="no" class="custom-control-input"><span class="custom-control-label">No</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="mb-3">Same as Inspection Date?</label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="same_as_inspection" value="yes" class="custom-control-input"><span class="custom-control-label">Yes</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" checked name="same_as_inspection" value="no" class="custom-control-input"><span class="custom-control-label">No</span>
                                </label>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="mb-3">Valuation Date</label>
                                <input type="date" name="valuation_date" class="form-control mb-5" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="mb-3">Inspection Date</label>
                                <input type="date" name="inspection_date" class="form-control mb-5" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="mb-3">Report Date</label>
                                <input type="date" name="report_date" class="form-control mb-5" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="mb-3">CJ Reference No</label>
                                <input type="text" name="cj_ref" class="form-control mb-5" placeholder="CJ REF" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="mb-3">Client Ref No</label>
                                <input type="text" name="clinet_ref" class="form-control mb-5" placeholder="CLINET REF" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="mb-3">Valuer</label>
                                <input type="text" name="valuer" class="form-control mb-5" placeholder="VALUER" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="mb-3">Double Signed?</label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="double_signed" value="yes" class="custom-control-input"><span class="custom-control-label">Yes</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" checked name="double_signed" value="no" class="custom-control-input"><span class="custom-control-label">No</span>
                                </label>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="mb-3">Valuer 2:</label>
                                <input type="text" name="valuer_2" class="form-control mb-5" placeholder="VALUER 2" value="" >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="mb-3">Tenure</label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" checked name="tenure" value="freehold" class="custom-control-input"><span class="custom-control-label">Freehold</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="tenure" value="long_leasehold" class="custom-control-input"><span class="custom-control-label">Long Leasehold</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" name="tenure" value="leasehold" class="custom-control-input"><span class="custom-control-label">Leasehold</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="mb-3">Basis of Value</label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="market_value" class="custom-control-input"><span class="custom-control-label">Market Value</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="market_value_special_assumption_vacant_posession" class="custom-control-input"><span class="custom-control-label">Market Value (special assumption vacant posession)</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="market_value_special_assumption_90_days" class="custom-control-input"><span class="custom-control-label">Market Value (special assumption 90 days)</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="market_value_special_assumption_180_days" class="custom-control-input"><span class="custom-control-label">Market Value (special assumption 180 days)</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="market_alue_1" class="custom-control-input"><span class="custom-control-label">Market Value (1)</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="market_value_2" class="custom-control-input"><span class="custom-control-label">Market Value (2)</span>
                                </label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="market_value_3" class="custom-control-input"><span class="custom-control-label">Market Value (3)</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="gross_development_alue" class="custom-control-input"><span class="custom-control-label">Gross Development Value</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="euv_sh" class="custom-control-input"><span class="custom-control-label">EUV-SH</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="aggregate_market_value_mv_vp" class="custom-control-input"><span class="custom-control-label">Aggregate Market Value (MV-VP)</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="market_rent" class="custom-control-input"><span class="custom-control-label">Market Rent</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="basis_of_value[]" value="reinstatememnt_value" class="custom-control-input"><span class="custom-control-label">Reinstatememnt Value</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="mb-3">Sector Overview</label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="sector_overview[]" value="commercial" class="custom-control-input"><span class="custom-control-label">Commercial</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="sector_overview[]" value="residential" class="custom-control-input"><span class="custom-control-label">Residential</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="sector_overview[]" value="hotels" class="custom-control-input"><span class="custom-control-label">Hotels</span>
                                </label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="sector_overview[]" value="dental" class="custom-control-input"><span class="custom-control-label">Dental</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="sector_overview[]" value="care homes" class="custom-control-input"><span class="custom-control-label">Care Homes</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="sector_overview[]" value="nurseries" class="custom-control-input"><span class="custom-control-label">Nurseries</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="mb-3">Methodology</label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="methodology[]" value="investment" class="custom-control-input"><span class="custom-control-label">Investment</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="methodology[]" value="comparable" class="custom-control-input"><span class="custom-control-label">Comparable</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="methodology[]" value="development" class="custom-control-input"><span class="custom-control-label">Development</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="methodology[]" value="development_with_social_housing" class="custom-control-input"><span class="custom-control-label">Development with Social Housing</span>
                                </label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="methodology[]" value="social_housing" class="custom-control-input"><span class="custom-control-label">Social Housing</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="methodology[]" value="trading_(hotel)" class="custom-control-input"><span class="custom-control-label">Trading (Hotel)</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="methodology[]" value="trading_(dental)" class="custom-control-input"><span class="custom-control-label">Trading (Dental)</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="methodology[]" value="trading_(nursery/care_home)" class="custom-control-input"><span class="custom-control-label">Trading (Nursery/Care Home)</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="mb-3">APPENDICIES</label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="letter_of_instruction" class="custom-control-input"><span class="custom-control-label">Letter of Instruction</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="letter_of_acknowledgement" class="custom-control-input"><span class="custom-control-label">Letter of Acknowledgement</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="title_plan" class="custom-control-input"><span class="custom-control-label">Title Plan</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="leases" class="custom-control-input"><span class="custom-control-label">Leases</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="particulars" class="custom-control-input"><span class="custom-control-label">Particulars</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="groundsure" class="custom-control-input"><span class="custom-control-label">Groundsure</span>
                                </label>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="development_appraisal" class="custom-control-input"><span class="custom-control-label">Development Appraisal</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="proposed plans" class="custom-control-input"><span class="custom-control-label">Proposed Plans</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="accounts" class="custom-control-input"><span class="custom-control-label">Accounts</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="cqc" class="custom-control-input"><span class="custom-control-label">CQC</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="appendicies[]" value="other" class="custom-control-input"><span class="custom-control-label">Other</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end validation form -->
        <!-- ============================================================== -->
    </div>


</div>