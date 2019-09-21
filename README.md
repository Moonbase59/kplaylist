# kPlaylist

**kPlaylist** is a music database that you manage via the web. With kPlaylist you can stream your music (ogg, mp3, wav, wma, etc.), you can upload, make playlists, share, search, download and a lot more.

This version was created from fragments of the (now defunct) kplaylist.net site and version 1.8.512 which can be downloaded from http://kplaylist.com/.

In addition to what 1.8.512 had to offer, **version 1.8.713** features:

* inclusion of "getid3" v1.9.17 for improved features & security
* support for FLAC, OGG and MP3 audio
* full UTF-8 support (web pages and MySQL using 'utf8mb4')
* support for PHP Imagick instead of GD
* FLAC transcoding support
* FLAC/OGG showing the correct "year"
* enhanced Icecast/Shoutcast streaming ("radio" feature)
* IPv6 support
* experimental lyrics support (may change, don’t overuse it)
* PHP7 compatibility (hopefully)
* … and more

---

**Note:** You do _not_ need to modify the `index.php` file itself. Just create a file `kpconfig.php` and put all your personal configurations in there. Use `example.kpconfig.php` as a starting point.

---

The auto-update feature can easily be used via crontab like this:
```
0 9 * * * /usr/bin/lynx -dump "http://127.0.0.1:8080/kplaylist/index.php?update=5000&user=autooperate"
```

The above means: Do an auto-update every morning at 9:00 a.m., assuming that kPlaylist runs on the local machine on port 8080, in a web folder called "kplaylist".

---

The "radio" (streaming) feature can most easily be used with my [ices0](https://github.com/Moonbase59/ices0) streaming client, using an ices shell script like the following:

```bash
#!/bin/sh

# ices shell script

# The first line should be a path to an audio file
#echo "/mp3s/arcadefire2.mp3"

# The next line is optional
#echo "The Arcade Fire - Neighbourhood #2 (Laika)"

# Get next filename to play from kPlaylist
# can be one or two lines, depends on setting of $cfg['appendradioname']
filename=`curl -s "http://127.0.0.1:8080/kplaylist/index.php?radionext=1&pass=password"`
echo "$filename"
```

again assuming kPlaylist runs on the local machine on port 8080, in a web folder called "kplaylist".

---

**Note:** I can and will only test this under Linux. It may work with other operating systems or not, up to you to find out.

---

**Note:** There are no guarantees or warranties whatsoever. This software may or might not be fit for your purpose. If you should decide to open your website to the public internet, please adhere to the applicable laws and be warned that you, and YOU alone, are responsible for any security risks imposed!

---

Visit the [kPlaylist Google Group](https://groups.google.com/forum/?nomobile=true#!forum/kplaylist).
