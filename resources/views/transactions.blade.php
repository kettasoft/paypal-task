<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Transactions</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

</head>
<body>
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Amount</th>
      <th scope="col">currency</th>
      <th scope="col">Total</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transactions as $transaction)
      <tr>
        <th scope="row">{{ $transaction->id }}</th>
        <th scope="row">{{ $transaction->name }}</th>
        <th scope="row">{{ $transaction->amount }}</th>
        <th scope="row">{{ $transaction->currency }}</th>
        <th scope="row">{{ $transaction->total }}</th>
        <th scope="row">{{ $transaction->status }}</th>
      </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>