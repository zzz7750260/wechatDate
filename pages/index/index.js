//index.js
//获取应用实例
const app = getApp()

Page({
  data: {
  },
  onLoad: function () {
    setTimeout(function(){
      wx.redirectTo({
        url: '../user/index'
      },5000)

    })
  }
})
