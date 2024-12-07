let audioContext;
let source;
let startTime = 0;
let pausedAt = 0;

self.onmessage = function(e) {
  if (e.data.action === 'init') {
    audioContext = new AudioContext();
    fetch(e.data.audioSrc)
      .then(response => response.arrayBuffer())
      .then(arrayBuffer => audioContext.decodeAudioData(arrayBuffer))
      .then(audioBuffer => {
        source = audioContext.createBufferSource();
        source.buffer = audioBuffer;
        source.connect(audioContext.destination);
        source.loop = true;
      });
  } else if (e.data.action === 'play') {
    if (pausedAt) {
      startTime = pausedAt;
      source.start(0, pausedAt);
    } else {
      startTime = audioContext.currentTime;
      source.start(0);
    }
    pausedAt = 0;
  } else if (e.data.action === 'pause') {
    const elapsed = audioContext.currentTime - startTime;
    source.stop();
    pausedAt = elapsed % source.buffer.duration;
    source = audioContext.createBufferSource();
    source.buffer = source.buffer;
    source.connect(audioContext.destination);
    source.loop = true;
  } else if (e.data.action === 'getState') {
    self.postMessage({
      isPlaying: audioContext && !audioContext.suspended && !pausedAt,
      currentTime: pausedAt || (audioContext ? (audioContext.currentTime - startTime) % source.buffer.duration : 0)
    });
  }
};