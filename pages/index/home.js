// pages/index/home.js
var theData;
Page({
  /**
   * 页面的初始数据
   */
  data: {
    items:[
      {
        id:1,
        username:'admin1',
        title:'测试1',
        date:'2018-12-02'
      }

    ],
    theTabBar: getApp().globalData.tabBar,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    /**向后端发出日记请求 */
    wx.request({
      url: 'http://localhost/wechatDate/app/api.php',
      data:{
        parameter:'diary',
        turl:'listDiary',
        theUserToken: getApp().globalData.userInfo.dev_token
      },
      method:'GET',
      header:{
        'content-tyoe':'application/json',
        //'content-type': 'application/x-www-form-urlencoded'
      },
      //dataType:'json',
      success:function(res){
        console.log(res.data);
       // console.log(res.header);
       // console.log(res.data.result)
        theData = res.data.result;
      }
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
    /**将获取的日记列表赋予全局 */
    this.setData({
      items: theData
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