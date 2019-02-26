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
    wx.request({
      url: 'http://localhost/wechatDate/app/api.php',
      data:{
        parameter:'login',
        turl:'checkLogin',
        theUserToken: getApp().globalData.userInfo.dev_token,

      },
      method:'GET',
      header:{
        //'content-type':'application/x-www-form-urlencoded'
        'content-type': 'application/json'
      },
      success:function(res){
        console.log(res.data);
        if(res.data.status == 1){
          wx.redirectTo({
            url: '../index/home',
          })

        }
        else{
          wx.redirectTo({
            url: './login',
          })
        }
      }
    })    
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