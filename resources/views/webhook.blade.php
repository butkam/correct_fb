<script type="text/javascript">
  app.get('/webhook/', function (req, res) {
    if (req.query['hub.verify_token'] === '34893489') {
      res.send(req.query['hub.challenge']);
    }
    res.send('Error, wrong validation token');
  })
</script>
