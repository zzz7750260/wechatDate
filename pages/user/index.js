// pages/user/index.js
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    /**获取是否存在token和username，如果存在就进行缓存登陆，如果不存在就跳转到登陆页面*/
    var token = wx.getStorageSync('token');
    var username = wx.getStorageSync('username');
    if (token && username){
      wx.request({
        url: 'http://localhost/wechatDate/app/api.php',
        data: {
          parameter: 'login',
          turl: 'checkLogin',
          theUserToken: getApp().globalData.userInfo.dev_token,
          theToken:token,
          username:username,
        },
        method: 'POST',
        header: {
          'content-type': 'application/x-www-form-urlencoded'
          //'content-type': 'application/json'
        },
        success: function (res) {
          console.log(res.data);
          if (res.data.status == 1) {
            wx.redirectTo({
              url: '../index/home',
            })

          }
          else {
            wx.redirectTo({
              url: './login',
            })
          }
        }
      })  
    }
    else{
      wx.redirectTo({
        url: './login',
      })      
    }
  
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})