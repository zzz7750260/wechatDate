// pages/index/diary.js

//设置传递日志内容的全局变量
var theDiary;

Page({

  /**
   * 页面的初始数据
   */
  data: {
    article:{},
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    //获取链接的参数
    console.log(options);
    //向后端发出文章的请求
    wx.request({
      url: 'http://localhost/wechatDate/app/api.php',
      data:{
        parameter:'diary',
        turl:'getDiary',
        token:getApp().globalData.userInfo.dev_token,
        id:options.id
      },
      method:'GET',
      header:{
        'content-type':'application/json'
      },
      success:function(res){
        console.log(res.data);
        //将返回的内容赋给全局
        theDiary = res.data.result;
      }
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
    this.setData({
      article:theDiary,
    })
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