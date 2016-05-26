<p>
    Geachte beheerder,<br />
    <br />
    Het contact formulier is zojuist door iemand ingevuld.<br />
    Hieronder staan de details:
</p>
<table style="border-collapse: collapse; border-color: #cccccc;" border="1">
    <tr>
        <td style="padding: 5px; font-weight: bold;">Database ID: </td>
        <td style="padding: 5px">{{ id }}</td>
    </tr>
    <tr>
        <td style="padding: 5px; font-weight: bold;">Gebruiker IP: </td>
        <td style="padding: 5px">{{ ip|e }}</td>
    </tr>
    <tr>
        <td style="padding: 5px; font-weight: bold;">Tijd verstuurd: </td>
        <td style="padding: 5px">{{ time }}</td>
    </tr>
    <tr>
        <td style="padding: 5px; font-weight: bold;">Gebruiker email: </td>
        <td style="padding: 5px">{{ email|e }}</td>
    </tr>
    <tr>
        <td style="padding: 5px; font-weight: bold;">Onderwerp: </td>
        <td style="padding: 5px">{{ subject|e }}</td>
    </tr>
    <tr>
        <td style="padding: 5px; font-weight: bold;">Bericht: </td>
        <td style="padding: 5px">{{ message|e|nl2br }}</td>
    </tr>
</table>
<p>
    Met vriendelijke groet,<br />
    SIEK-bot
</p>
