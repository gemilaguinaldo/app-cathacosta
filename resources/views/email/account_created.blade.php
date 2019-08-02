@extends('email.base')

@section('content')

<div>
	<h3>
		Hello {{ $account->firstname }}!
	</h3>
	<p>
	{{ config('app.name') }} created an account for you! Below is your log-in credentials:
	</p>
	<table>
		<tr>
			<th width="20%" align="left">Email: </th>
			<td align="left">{{ $account->email }}</td>
		</tr>
		<tr>
			<th width="20%" align="left">Password: </th>
			<td align="left">{{ $account->password }}</td>
		</tr>
	</table>
	<br>
	<p><a href="{{ config('app.url') }}/login">Please click here to log your account.</a></p>
	<p>
		If you didn't authorized anyone to create an account, please disregard this email.<br>Thank you!<br><br>
		<small>Please do not reply to this message. This message is a service email related to your use of {{ config('app.name') }}.</small>
	</p>
</div>


@endsection