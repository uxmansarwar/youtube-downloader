#!C:/python/python
from pytube import YouTube
from pytube.helpers import safe_filename, target_directory
import requests
import cgi
import json
print()


form = cgi.FieldStorage()
user_url = str(form['user_url'].value)

# print(user_url)
# # import the package

my_video = YouTube(user_url)
# my_video = YouTube("YT video link")

# print("*********************Video Title************************")
# #get Video Title
# file_name =   + ".mp3"
file_path = "../dl_files/" + my_video.video_id
downloaded = my_video.streams.filter(only_audio=True).all()[0].download(file_path)

# my_video.streams.filter(only_audio=True).all()[0].url
# print(downloaded)

results = {"video_title": my_video.title, "dl_url":downloaded, "video_id":my_video.video_id}

print(json.dumps(results))
###################################################completed


# my_video = YouTube("https://www.youtube.com/watch?v=udSsxAofqTA")
# file_name =  my_video.video_id + ".mp3"
# file_path = "../dl_files/"
# my_video.streams.filter(only_audio=True).all()[0].download("",file_path, file_name)
# print(my_video.video_id)







# print("********************Tumbnail Image***********************")
# #get Thumbnail Image
# print(my_video.thumbnail_url)

# print("********************Download video*************************")
# #get all the stream resolution for the
# for stream in my_video.streams:
#     print(stream)

# #set stream resolution
# my_video = my_video.streams.get_highest_resolution()

# #or
# #my_video = my_video.streams.first()

# #Download video
# my_video.download()
