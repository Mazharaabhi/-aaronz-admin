
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="images/favicon.png" rel="icon" />
		<title>General Invoice - Myridepay</title>
		<meta name="author" content="harnishdesign.net">
		<!-- Web Fonts
			======================= -->
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
		<!-- Stylesheet
			======================= -->
	</head>
	<body style='background: #e7e9ed;color: #535b61; font-family: "Poppins", sans-serif;font-size: 14px; line-height: 22px;'>
		<!-- Container -->
		<div style='margin: 15px auto;padding: 70px;max-width: 850px;background-color: #fff;border: 1px solid #ccc;-moz-border-radius: 6px;-webkit-border-radius: 6px;-o-border-radius: 6px;border-radius: 6px;width: 100%;box-sizing: border-box;'>
			<!-- Header -->
			<header style='    display: block;'>
				<div style='display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;width: 100%;margin: 0 auto;text-align: right!important;box-sizing: border-box;'>
					<div  style='text-align: left!important;    margin-bottom: 0!important;-ms-flex: 0 0 58.333333%;flex: 0 0 58.333333%;max-width: 58.333333%;position: relative;width: 100%;padding-right: 15px;padding-left: 15px;box-sizing: border-box;'>
						<img loading="lazy" id="logo" src="{{ URL::to('/public/common/pdf') }}/images/myridepay.svg" title="Myridepay" alt="Myridepay" width='200' />
					</div>
					<div style='-ms-flex: 0 0 41.666667%;flex: 0 0 41.666667%;max-width: 41.666667%;text-align: right!important;box-sizing: border-box;'>
						<h4 style='font-size: 1.75rem !important;margin-bottom: 0!important;font-weight: 500;line-height: 1.2;box-sizing: border-box;margin-top: 0;'>TAX INVOICE</h4>
					</div>
				</div>
				<hr style='margin-top: 1rem;margin-bottom: 1rem; border: 0;border-top: 1px solid rgba(0,0,0,.1);box-sizing: content-box;height: 0;overflow: visible;'>
			</header>
			<!-- Main Content -->
			<main>
				<div style='display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;width: 100%;margin: 0 auto;'>
					<div  style='-ms-flex: 0 0 50%;flex: 0 0 50%;max-width: 50%;'><strong>Date: </strong> {{ date('d/m/Y') }}</div>
					<div  style='text-align: right!important;-ms-flex: 0 0 50%;flex: 0 0 50%;max-width: 50%;'> <strong>Invoice No:</strong> {{ $invoice_no }}</div>
				</div>
				<hr style='margin-top: 1rem;margin-bottom: 1rem; border: 0;border-top: 1px solid rgba(0,0,0,.1);box-sizing: content-box;height: 0;overflow: visible;'>
				<div style='display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;width: 100%;margin: 0 auto;'>
					<div style='-ms-flex: 0 0 50%;flex: 0 0 50%;max-width: 50%;order: 1;text-align: right!important;'>
						<strong>Pay To:</strong>
						<address style="margin-bottom: 1rem;font-style: normal;line-height: inherit;">
							{{ $user['company_name'] }}<br />
							{{ $user['address'] }}<br />
							{{ $user['email'] }}
						</address>
					</div>
					<div  style='-ms-flex: 0 0 50%;flex: 0 0 50%;max-width: 50%;order: 0;'>
						<strong>Invoiced To:</strong>
						<address style="margin-bottom: 1rem;font-style: normal;line-height: inherit;">
							{{ $company['company_name'] }}<br />
							{{ $company['address'] }}<br />
							{{ $company['email'] }}
						</address>
					</div>
				</div>
				<div class="" style='position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border:none;border-radius: .25rem;'>
					<div style='padding: 0!important;-ms-flex: 1 1 auto;flex: 1 1 auto;min-height: 1px;'>
						<div class="table-responsive" style=" display: block;width: 100%;overflow-x: hidden;-webkit-overflow-scrolling: touch;">
							<table class="table mb-0" style="box-sizing:border-box;width: 100%; color: #535b61; margin-bottom: 0!important;border-collapse: collapse;box-sizing: border-box;">
								{{-- <thead class="card-header" style='    background-color: rgb(0 0 0 / 78%) !important;
									color: #fff !important;  padding: .75rem 1.25rem; margin-bottom: 0;background-color: rgba(0,0,0,.03);border-bottom: 1px solid rgba(0,0,0,.125);'>
									<tr>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;"><strong>Service</strong></td>
										<td  style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 33.333333%; flex: 0 0 33.333333%; max-width: 33.333333%; position: relative; width: 100%;border-top: 1px solid #dee2e6;"><strong>Description</strong></td>
										<td  style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;"><strong>Rate</strong></td>
										<td  style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 8.333333%;flex: 0 0 8.333333%;max-width: 8.333333%; position: relative; width: 100%;border-top: 1px solid #dee2e6;"><strong>QTY</strong></td>
										<td  style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;"><strong>Amount</strong></td>
									</tr>
								</thead>
								<tbody style='border: 2px solid rgba(0,0,0,.125);border-bottom: 1px solid rgba(0,0,0,.125); '>
									<tr>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">Design</td>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 33.333333%; flex: 0 0 33.333333%; max-width: 33.333333%; position: relative; width: 100%;border-top: 1px solid #dee2e6;">Creating a website design</td>
										<td class="col-2 text-center border-0" style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">$50.00</td>
										<td class="col-1 text-center border-0" style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 8.333333%;flex: 0 0 8.333333%;max-width: 8.333333%; position: relative; width: 100%;border-top: 1px solid #dee2e6;">10</td>
										<td class="col-2 text-right border-0"  style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">$500.00</td>
									</tr>
									<tr>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">Development</td>
										<td class="text-1" style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 33.333333%; flex: 0 0 33.333333%; max-width: 33.333333%; position: relative; width: 100%;border-top: 1px solid #dee2e6;">Website Development</td>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">$120.00</td>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 8.333333%;flex: 0 0 8.333333%;max-width: 8.333333%; position: relative; width: 100%;border-top: 1px solid #dee2e6;">10</td>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">$1200.00</td>
									</tr>
									<tr>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">SEO</td>
										<td class="text-1" style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 33.333333%; flex: 0 0 33.333333%; max-width: 33.333333%; position: relative; width: 100%;border-top: 1px solid #dee2e6;">Optimize the site for search engines (SEO)</td>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">$450.00</td>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 8.333333%;flex: 0 0 8.333333%;max-width: 8.333333%; position: relative; width: 100%;border-top: 1px solid #dee2e6;">1</td>
										<td style=" padding: .75rem;vertical-align: top;-ms-flex: 0 0 25%; flex: 0 0 25%; max-width: 25%;  position: relative; width: 100%;border-top: 1px solid #dee2e6;">$450.00</td>
									</tr>
								</tbody> --}}
								<tfoot class="card-footer">
									<tr>
										<td colspan="4" style="text-align:right;border:none; padding: .75rem;vertical-align: top;"><strong>Sub Total:</strong></td>
										<td style="text-align:right;border:none; padding: .75rem;vertical-align: top;">{{ $amount }}</td>
									</tr>
									<tr>
										<td colspan="4" style="text-align:right; border:none; padding: .75rem;vertical-align: top;"><strong>5% Tax:</strong></td>
										<td style="text-align:right;border:none; padding: .75rem;vertical-align: top;">{{ $tax }}</td>
									</tr>
									<tr>
										<td colspan="4" style="text-align:right;padding:0;border:none;vertical-align: top;"><strong style='background:#ddd ;padding: 13.5px 27px;position: relative;top: 12px;'>Total:</strong></td>
										<td style="text-align:right; border:none; background:#ddd; padding: .75rem;vertical-align: top;">{{ $total }}</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</main>
			<!-- Footer -->
			{{-- <footer style="text-align:center;margin-top:30px">
				<p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
			</footer> --}}
		</div>
	</body>
</html>
